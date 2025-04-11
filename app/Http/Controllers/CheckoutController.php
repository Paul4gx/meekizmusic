<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(Beat $beat)
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        return view('checkout.index', compact('beat'));
    }

    public function initialize(Request $request)
    {
        $request->validate([
            'beat_id' => 'required|exists:beats,id',
        ]);

        $beat = Beat::findOrFail($request->beat_id);
        $user = Auth::user();

        // Check if beat is already sold
        if ($beat->is_sold) {
            return back()->with('error', 'This beat has already been sold.');
        }

        try {
            // Initialize Paystack payment
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.paystack.co/transaction/initialize', [
                'email' => $user->email,
                'amount' => $beat->price * 100, // Convert to kobo
                'callback_url' => route('checkout.callback'),
                'metadata' => [
                    'beat_id' => $beat->id,
                    'user_id' => $user->id,
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['data']['authorization_url'])) {
                    return redirect($data['data']['authorization_url']);
                }
            }

            return back()->with('error', 'Failed to initialize payment. Please try again.');

        } catch (\Exception $e) {
            \Log::error('Payment initialization failed: ' . $e->getMessage());
            return back()->with('error', 'Payment initialization failed. Please try again later.');
        }
    }

    public function callback(Request $request)
    {
        try {
            // Verify the transaction
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
                'Content-Type' => 'application/json',
            ])->get('https://api.paystack.co/transaction/verify/' . $request->reference);

            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['data']['status'] === 'success') {
                    $beat = Beat::findOrFail($data['data']['metadata']['beat_id']);
                    $user = Auth::user();

                    // Create purchase record
                    Purchase::create([
                        'user_id' => $user->id,
                        'beat_id' => $beat->id,
                        'amount' => $beat->price,
                        'payment_reference' => $request->reference,
                        'status' => 'completed',
                    ]);

                    // Mark beat as sold
                    $beat->update(['is_sold' => true]);

                    return redirect()->route('purchases.index')
                        ->with('success', 'Purchase completed successfully!');
                }
            }

            return redirect()->route('purchases.index')
                ->with('error', 'Payment verification failed. Please contact support.');

        } catch (\Exception $e) {
            return redirect()->route('purchases.index')
                ->with('error', 'Payment processing failed: ' . $e->getMessage());
        }
    }
} 
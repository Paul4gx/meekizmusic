<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Purchase;
use App\Models\Transaction;
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
                'amount' => $beat->price * 100, // kobo
                'callback_url' => route('checkout.callback'),
                'metadata' => [
                    'beat_id' => $beat->id,
                    'user_id' => $user->id,
                ],
            ]);
    
            if ($response->successful()) {
                $data = $response->json();
    
                if (isset($data['data']['reference'])) {
                    // 💾 Store transaction in DB
                    Transaction::create([
                        'user_id' => $user->id,
                        'beat_id' => $beat->id,
                        'reference' => $data['data']['reference'],
                        'amount' => $beat->price * 100,
                        'status' => 'pending',
                        'currency' => 'NGN',
                        'metadata' => json_encode([
                            'beat_title' => $beat->title,
                            'user_email' => $user->email,
                        ]),
                    ]);
                }
    
                if (isset($data['data']['authorization_url'])) {
                    return redirect($data['data']['authorization_url']);
                }
            }
    
            return back()->with('error', 'Failed to initialize payment. Please try again.');
        } catch (\Exception $e) {
            Log::error('Payment initialization failed: ' . $e->getMessage());
            return back()->with('error', 'Payment initialization failed. Please try again later.');
        }
    }

    public function callback(Request $request)
{
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.paystack.secret_key'),
            'Content-Type' => 'application/json',
        ])->get('https://api.paystack.co/transaction/verify/' . $request->reference);

        if ($response->successful()) {
            $data = $response->json();

            if ($data['data']['status'] === 'success') {
                $beatId = $data['data']['metadata']['beat_id'];
                $userId = $data['data']['metadata']['user_id'];
            
                $beat = Beat::findOrFail($beatId);
            
                // Update the transaction record
                $transaction = Transaction::where('reference', $request->reference)->first();
                if ($transaction) {
                    $transaction->update([
                        'status' => 'success',
                        'paid_at' => now(),
                        'channel' => $data['data']['channel'],
                        'currency' => $data['data']['currency'],
                        'gateway_response' => $data['data']['gateway_response'],
                    ]);
                }
            
                // Handle existing purchase with a 'failed' status
                $existingPurchase = Purchase::where('user_id', $userId)
                                            ->where('beat_id', $beatId)
                                            ->first();
            
                if ($existingPurchase) {
                    // If purchase exists and status is 'failed', update the status to 'completed'
                    if ($existingPurchase->status === 'failed') {
                        $existingPurchase->update([
                            'status' => 'completed', // Update status to completed after successful payment
                            'transaction_id' => $transaction ? $transaction->id : null,
                        ]);
            
                        // Mark beat as sold
                        $beat->update(['is_sold' => true]);
            
                        return redirect()->route('purchased.index')
                        ->with('success', 'Payment successful! Purchase completed, you can now download the full beat!');
                    }
                } else {
                    // Create a new purchase record if no previous purchase exists
                    Purchase::create([
                        'user_id' => $userId,
                        'beat_id' => $beat->id,
                        'amount' => $beat->price,
                        'transaction_id' => $transaction ? $transaction->id : null,
                        'status' => 'completed', // Store as 'completed' for successful transactions
                    ]);
            
                    // Mark beat as sold
                    $beat->update(['is_sold' => true]);
            
                    return redirect()->route('purchased.index')
                    ->with('success', 'Payment successful! Purchase completed, you can now download the full beat!');
                }
            
            } elseif ($data['data']['status'] === 'failed') {
                $beatId = $data['data']['metadata']['beat_id'];
                $userId = $data['data']['metadata']['user_id'];
            
                $beat = Beat::findOrFail($beatId);
            
                // Update the transaction record for failed status
                $transaction = Transaction::where('reference', $request->reference)->first();
                if ($transaction) {
                    $transaction->update([
                        'status' => 'failed',
                        'paid_at' => now(),
                        'channel' => $data['data']['channel'],
                        'currency' => $data['data']['currency'],
                        'gateway_response' => $data['data']['gateway_response'],
                    ]);
                }
            
                // Handle existing purchase with a 'failed' status
                $existingPurchase = Purchase::where('user_id', $userId)
                                            ->where('beat_id', $beatId)
                                            ->first();
            
                if ($existingPurchase) {
                    // If purchase exists and status is 'failed', update the status to 'failed' again
                    if ($existingPurchase->status === 'failed') {
                        $existingPurchase->update([
                            'status' => 'failed', // Keep the status as 'failed' for retry
                            'transaction_id' => $transaction ? $transaction->id : null,
                        ]);
                    }
                } else {
                    // Create a new purchase record with failed status if no previous purchase exists
                    Purchase::create([
                        'user_id' => $userId,
                        'beat_id' => $beat->id,
                        'amount' => $beat->price,
                        'transaction_id' => $transaction ? $transaction->id : null,
                        'status' => 'failed', // Store as 'failed' for failed transactions
                    ]);
                }
            
                return redirect()->route('purchased.index')
                    ->with('error', 'Payment failed. Please try again.');
            
            } elseif ($data['data']['status'] === 'unknown') {
                $beatId = $data['data']['metadata']['beat_id'];
                $userId = $data['data']['metadata']['user_id'];
            
                $beat = Beat::findOrFail($beatId);
            
                // Update the transaction record for unknown status
                $transaction = Transaction::where('reference', $request->reference)->first();
                if ($transaction) {
                    $transaction->update([
                        'status' => 'unknown',
                        'paid_at' => now(),
                        'channel' => $data['data']['channel'],
                        'currency' => $data['data']['currency'],
                        'gateway_response' => $data['data']['gateway_response'],
                    ]);
                }
            
                // Handle existing purchase with a 'failed' status
                $existingPurchase = Purchase::where('user_id', $userId)
                                            ->where('beat_id', $beatId)
                                            ->first();
            
                if ($existingPurchase) {
                    // If purchase exists and status is 'unknown', update the status to 'unknown'
                    if ($existingPurchase->status === 'unknown') {
                        $existingPurchase->update([
                            'status' => 'unknown', // Keep the status as 'unknown'
                            'transaction_id' => $transaction ? $transaction->id : null,
                        ]);
                    }
                } else {
                    // Create a new purchase record with unknown status if no previous purchase exists
                    Purchase::create([
                        'user_id' => $userId,
                        'beat_id' => $beat->id,
                        'amount' => $beat->price,
                        'transaction_id' => $transaction ? $transaction->id : null,
                        'status' => 'unknown', // Store as 'unknown' for unknown transactions
                    ]);
                }
            
                return redirect()->route('purchased.index')
                    ->with('warning', 'Payment status is unknown. Please contact customer care.');
            }
            
        }

        return redirect()->route('purchased.index')
            ->with('error', 'Payment verification failed. Please contact support.');

    } catch (\Exception $e) {
        Log::error('Paystack callback error: ' . $e->getMessage());

        return redirect()->route('purchased.index')
            ->with('error', 'Payment processing failed: ' . $e->getMessage());
    }
}
} 
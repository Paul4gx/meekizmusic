<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasedController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $orders = Order::where('user_id', $user->id)
            ->with('beat')
            ->latest()
            ->paginate(10);

        return view('purchased.index', compact('orders'));
    }

    public function download(Order $order)
    {
        // Check if the user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if the order is completed
        if ($order->status !== 'completed') {
            return back()->with('error', 'This order is not completed yet.');
        }

        // Get the beat's audio file path
        $audioPath = storage_path('app/public/' . $order->beat->audio_file);

        // Check if the file exists
        if (!file_exists($audioPath)) {
            return back()->with('error', 'Audio file not found.');
        }

        // Return the file for download
        return response()->download($audioPath, $order->beat->title . '.mp3');
    }
} 
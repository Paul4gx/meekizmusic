<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasedController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $orders = Purchase::where('user_id', $user->id)
            ->with('beat')
            ->latest()
            ->paginate(10);

        return view('purchased.index', compact('orders'));
    }

public function download(Purchase $order)
{
    // Check if the user owns this order
    if ($order->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Check if the order is completed
    if ($order->status !== 'completed') {
        return back()->with('error', 'This order is not completed yet.');
    }

    // Get the beat's audio file path in the private storage folder
    $audioPath = storage_path('app/private/' . $order->beat->file_url); 
    // Check if the file exists
    if (!file_exists($audioPath)) {
        return back()->with('error', 'Audio file not found.');
    }

    // Return the file for download with a secure response
    return response()->download($audioPath, $order->beat->title . '.' . pathinfo($audioPath, PATHINFO_EXTENSION))
        ->setContentDisposition('attachment', $order->beat->title . '.' . pathinfo($audioPath, PATHINFO_EXTENSION));
}

} 
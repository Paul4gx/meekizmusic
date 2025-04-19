<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Purchase::with(['user', 'beat'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Purchase $order)
    {
        $order->load(['user', 'beat']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Purchase $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully.');
    }

    public function destroy(Purchase $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
} 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beat;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get recently played beats (placeholder for now)
        $recentlyPlayed = Beat::latest()->take(3)->get();
        
        // Get wishlist items
        $wishlistItems = $user->wishlist()->latest()->take(6)->get();
        
        // Get recent purchases
        $recentPurchases = Order::where('user_id', $user->id)
            ->with('beat')
            ->latest()
            ->take(5)
            ->get();
        
        // Get statistics
        $stats = [
            'total_purchases' => Order::where('user_id', $user->id)->count(),
            'total_spent' => Order::where('user_id', $user->id)->sum('amount'),
            'wishlist_count' => $user->wishlist()->count(),
        ];

        return view('dashboard.index', compact('recentlyPlayed', 'wishlistItems', 'recentPurchases', 'stats'));
    }
} 
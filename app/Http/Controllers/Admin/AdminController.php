<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Beat;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get total counts
        $totalUsers = User::count();
        $totalBeats = Beat::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('amount');

        // Get this month's counts
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count();
        $newBeatsThisMonth = Beat::whereMonth('created_at', Carbon::now()->month)->count();
        $newOrdersThisMonth = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $revenueThisMonth = Order::whereMonth('created_at', Carbon::now()->month)->sum('amount');

        // Get recent orders
        $recentOrders = Order::with(['user', 'beat'])
            ->latest()
            ->take(5)
            ->get();

        // Get recent users
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Get revenue chart data (last 6 months)
        $revenueChartData = $this->getRevenueChartData();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBeats',
            'totalOrders',
            'totalRevenue',
            'newUsersThisMonth',
            'newBeatsThisMonth',
            'newOrdersThisMonth',
            'revenueThisMonth',
            'recentOrders',
            'recentUsers',
            'revenueChartData'
        ));
    }

    private function getRevenueChartData()
    {
        $months = collect(range(5, 0))->map(function($month) {
            return Carbon::now()->subMonths($month);
        });

        $labels = $months->map(function($month) {
            return $month->format('M Y');
        });

        $data = $months->map(function($month) {
            return Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
        });

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
} 
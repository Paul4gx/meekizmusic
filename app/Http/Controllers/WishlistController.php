<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beat;

class WishlistController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wishlistItems = $user->wishlist()->paginate(12);
        
        return view('wishlist.index', compact('wishlistItems'));
    }
    
    public function toggle(Request $request, Beat $beat)
    {
        $user = auth()->user();
        
        if ($user->wishlist()->where('beat_id', $beat->id)->exists()) {
            $user->wishlist()->detach($beat->id);
            $message = 'Beat removed from wishlist';
        } else {
            $user->wishlist()->attach($beat->id);
            $message = 'Beat added to wishlist';
        }
        
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
} 
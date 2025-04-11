<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beat;
use Illuminate\Support\Facades\Auth;

class BeatController extends Controller
{
    public function getAllBeats()
    {
        return response()->json(Beat::where('is_sold', false)->with('genres')->get());
    }

    public function getLatestBeats()
    {
        return response()->json(Beat::where('is_sold', false)->latest()->take(10)->get());
    }

    public function getMostPreviewedBeats()
    {
        return response()->json(Beat::where('is_sold', false)->orderBy('views', 'desc')->take(10)->get());
    }

    public function searchBeats(Request $request)
    {
        $query = $request->input('query');
        
        $beats = Beat::where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('keywords', 'LIKE', "%$query%")
            ->orWhereHas('genres', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->with('genres')
            ->get();

        return response()->json($beats);
    }

    public function getHeroBeat()
    {
        return response()->json(Beat::where('is_sold', false)->inRandomOrder()->first());
    }

    public function show(Beat $beat)
    {
        $relatedBeats = Beat::where('id', '!=', $beat->id)
            ->whereHas('genres', function ($query) use ($beat) {
                $query->whereIn('genres.id', $beat->genres->pluck('id'));
            })
            ->inRandomOrder()
            ->take(4)
            ->get();
    
        $wishlistBeatIds = Auth::check() 
            ? Auth::user()->wishlist()->pluck('beat_id')->flip()
            : collect();
    
        // Attach inWishlist status to beats
        $relatedBeats->each(fn ($beat) => $beat->inWishlist = isset($wishlistBeatIds[$beat->id]));
    
        $isInWishlist = isset($wishlistBeatIds[$beat->id]);
    
        return view('beats.show', compact('beat', 'relatedBeats', 'isInWishlist'));
    }
}


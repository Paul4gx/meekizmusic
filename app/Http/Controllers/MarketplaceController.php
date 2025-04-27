<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Genre;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function index(Request $request)
{
    $query = Beat::with('genres');
    $adminSettings = AdminSetting::first();

    // Search
    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search, $adminSettings) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");

            if ($adminSettings && $adminSettings->quick_search) {
                foreach ($adminSettings->quick_search as $quickWord) {
                    if (stripos($search, $quickWord) !== false) {
                        $q->orWhere('title', 'like', "%{$quickWord}%")
                          ->orWhere('description', 'like', "%{$quickWord}%");
                    }
                }
            }
        });
    }

    // Genre filter
    if ($request->has('genre')) {
        $genre = $request->genre;
        $query->whereHas('genres', function($q) use ($genre) {
            $q->where('genres.id', $genre)
            ->orWhere('genres.name', 'like', "%{$genre}%")
            ->orWhere('genres.slug', 'like', "%{$genre}%");
        });
    }

    // Price range filter
    if ($request->has('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->has('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // BPM range filter
    if ($request->has('min_bpm')) {
        $query->where('bpm', '>=', $request->min_bpm);
    }
    if ($request->has('max_bpm')) {
        $query->where('bpm', '<=', $request->max_bpm);
    }

    // Sorting
    switch ($request->sort) {
        case 'price_low_high':
            $query->orderBy('price', 'asc');
            break;
        case 'price_high_low':
            $query->orderBy('price', 'desc');
            break;
        case 'most_popular':
            $query->orderBy('downloads', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    // Paginate results
    $beats = $query->paginate(12);
    $genres = Genre::all();

    // Attach wishlist status efficiently
    $beats = $this->attachWishlistStatus($beats);

    return view('marketplace.index', compact('beats', 'genres', 'adminSettings'));
}
    public function afrobeat(Request $request)
{
    $query = Beat::with('genres')->whereHas('genres', function($q) {
                    $q->where('name', 'like', '%afrobeat%');
                });
    // Paginate results
    $beats = $query->paginate(12);
    $genres = Genre::all();
    // Attach wishlist status efficiently
    $beats = $this->attachWishlistStatus($beats);

    return view('marketplace.afrobeat', compact('beats', 'genres'));
}
public function featured(Request $request) 
{
    $beats = Beat::where('is_featured', true) // true to get featured beats
                 ->where('is_sold', false)    // exclude sold beats
                 ->with('genres')
                 ->paginate(12);
    $genres = Genre::all();

    // Attach wishlist status efficiently
    $beats = $this->attachWishlistStatus($beats);

    return view('marketplace.featured', compact('beats', 'genres'));
}

    public function keywords()
    {
        // TODO: Implement keyword search functionality
        return view('marketplace.keywords');
    }

    public function tags()
    {
        // TODO: Fetch tags from database
        return view('marketplace.tags');
    }
    private function attachWishlistStatus($beats)
{
    if (Auth::check()) {
        // Fetch all wishlist beat IDs in one query
        $wishlistBeatIds = Auth::user()->wishlist()->pluck('beat_id')->flip();

        // Attach 'inWishlist' status to each beat
        $beats->getCollection()->transform(function ($beat) use ($wishlistBeatIds) {
            $beat->inWishlist = isset($wishlistBeatIds[$beat->id]);
            return $beat;
        });
    } else {
        // If user is not authenticated, set 'inWishlist' to false
        $beats->getCollection()->transform(function ($beat) {
            $beat->inWishlist = false;
            return $beat;
        });
    }

    return $beats;
}

} 
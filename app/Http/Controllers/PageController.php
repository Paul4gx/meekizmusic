<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Genre;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        // $beats = Beat::with('genres')->latest()
        // ->take(9)
        // ->get();
        // $beats = $this->attachWishlistStatus($beats);
        $heroBeat =Beat::inRandomOrder()->first();
        // Get the latest 9 featured beats that are not sold, and eager load genres
            $latestBeat = Beat::with('genres') // Eager load the genres relationship
            ->latest() // Sort by the most recent
            ->take(8) // Get only the 9 most recent
            ->get();

            // Get the latest 6 beats that are not sold, and eager load genres
            $featuredBeats = Beat::where('is_sold', false)
            ->where('is_featured', true)
            ->with('genres') // Eager load the genres relationship
            ->latest() // Sort by the most recent
            ->take(6) // Get only the 6 most recent
            ->get();
            $genres = Genre::all();
            $latestBeat = $this->attachWishlistStatus($latestBeat);
            $featuredBeats = $this->attachWishlistStatus($featuredBeats);
        // Get admin settings for countdown
        $adminSettings = AdminSetting::first();
        return view('home.index', compact('featuredBeats', 'adminSettings','genres','heroBeat','latestBeat'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        $contact_info = AdminSetting::first()->contact_info;
        return view('pages.contact',compact('contact_info'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Send email using Laravel Mail
        // Mail::to('support@meekismusic.com')->send(new ContactFormSubmission($validated));

        return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you soon!');
    }
    private function attachWishlistStatus($beats)
    {
        if (Auth::check()) {
            // Fetch all wishlist beat IDs in one query
            $wishlistBeatIds = Auth::user()->wishlist()->pluck('beat_id')->flip();
    
            // Attach 'inWishlist' status to each beat
            $beats->transform(function ($beat) use ($wishlistBeatIds) {
                $beat->inWishlist = isset($wishlistBeatIds[$beat->id]);
                return $beat;
            });
        } else {
            // If user is not authenticated, set 'inWishlist' to false
            $beats->transform(function ($beat) {
                $beat->inWishlist = false;
                return $beat;
            });
        }
    
        return $beats;
    }
} 
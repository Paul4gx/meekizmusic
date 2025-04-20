<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beat;
use App\Models\Genre;
use App\Jobs\GenerateBeatPreview;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BeatController extends Controller
{
    protected $imageManager;

    public function __construct()
    {
        try {
            $this->imageManager = new ImageManager(new Driver());
        } catch (\Exception $e) {
            Log::error('Failed to initialize ImageManager: ' . $e->getMessage());
            throw $e;
        }
    }

    public function index()
    {
        $beats = Beat::with(['user', 'genres'])->latest()->paginate(10);
        return view('admin.beats.index', compact('beats'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.beats.create', compact('genres'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'bpm' => 'required|numeric|min:0',
                'duration' => 'required|string',
                'audio_file' => 'required|file|mimes:mp3,wav|max:10240',
                'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'genre_ids' => 'required|array',
                'genre_ids.*' => 'exists:genres,id',
                'trimmed_audio_file' => 'required|file|mimes:wav'
            ]);

            $trimmedPath = $request->file('trimmed_audio_file')->store('beats/previews');
            // Handle file uploads
            $fileUrl = $request->file('audio_file')->store('beats/audio'); // Stored privately (default disk)
            if ($request->hasFile('cover_image')) {
                $manager = new ImageManager(new Driver());
                $file = $request->file('cover_image');
                $filename = 'beats/covers/' . Str::random(20) . '.webp';
                
                // v3 uses 'read()' instead of 'make()'
                $image = $manager->read($file)
                    ->cover(500, 500) // equivalent to fit() in v2
                    ->toWebp(85);     // equivalent to encode('webp', 85)
                
                Storage::disk('public')->put($filename, (string) $image);
                $coverImage = $filename;
            }
            // $coverImage = $request->file('cover_image')->store('beats/covers', 'public'); // Stored privately (default disk)
            // Extract dominant color from cover image
            $colorAccent = '#000000'; // Default color
            try {
                $colorAccent = $this->getDominantColor($request->file('cover_image'));
            } catch (\Exception $e) {
                Log::error('Failed to extract color accent: ' . $e->getMessage());
            }

            // Create beat
            $beat = Beat::create([
                'title' => $request->title,
                'description' => $request->description,
                'preview_url' => $trimmedPath,
                'price' => $request->price,
                'bpm' => $request->bpm,
                'duration' => $request->duration,
                'file_url' => $fileUrl,
                'cover_image' => $coverImage,
                'color_accent' => $colorAccent,
                'user_id' => Auth::id(),
                'is_sold' => false,
                'is_featured' => $request->has('is_featured'),
                'status' => $request->status ?? 'draft',
            ]);

            // Attach genres
            $beat->genres()->attach($request->genre_ids);

            // Generate preview
            // GenerateBeatPreview::dispatch($beat);

            return redirect()->route('admin.beats.index')
                ->with('success', 'Beat created successfully.')
                ->with('preview_generation', true);
        } catch (\Exception $e) {
            Log::error('Failed to create beat: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Failed to create beat. Please try again.');
        }
    }

    private function getDominantColor($image)
    {
        try {
            // Check if GD extension is available
            if (!extension_loaded('gd')) {
                Log::error('GD extension is not installed');
                return '#000000'; // Return black as fallback
            }

            // Load the image using Intervention Image
            $img = $this->imageManager->read($image);
            
            // Resize image to a smaller size for faster processing
            $img->resize(100, 100);
            
            // Get the image data
            $width = $img->width();
            $height = $img->height();
            
            // Initialize color frequency array
            $colorFrequency = [];
            
            // Sample pixels to find the most frequent color
            for ($x = 0; $x < $width; $x += 5) {
                for ($y = 0; $y < $height; $y += 5) {
                    $color = $img->pickColor($x, $y);
                    
                    // Get RGB values from the Color object
                    $rgb = $color->toArray();
                    $r = $rgb[0];
                    $g = $rgb[1];
                    $b = $rgb[2];
                    
                    // Create a color key for the frequency array
                    $colorKey = sprintf("%d,%d,%d", $r, $g, $b);
                    
                    // Increment frequency for this color
                    if (!isset($colorFrequency[$colorKey])) {
                        $colorFrequency[$colorKey] = [
                            'count' => 0,
                            'rgb' => [$r, $g, $b]
                        ];
                    }
                    $colorFrequency[$colorKey]['count']++;
                }
            }
            
            // Find the color with highest frequency
            $maxFrequency = 0;
            $dominantColor = null;
            
            foreach ($colorFrequency as $color) {
                if ($color['count'] > $maxFrequency) {
                    $maxFrequency = $color['count'];
                    $dominantColor = $color['rgb'];
                }
            }
            
            // Convert RGB to hex
            if ($dominantColor) {
                return sprintf("#%02x%02x%02x", $dominantColor[0], $dominantColor[1], $dominantColor[2]);
            }
            
            return '#000000'; // Return black as fallback
            
        } catch (\Exception $e) {
            Log::error('Failed to process image: ' . $e->getMessage());
            return '#000000'; // Return black as fallback
        }
    }

    public function edit(Beat $beat)
    {
        $genres = Genre::all();
        $beat->load('genres');
        return view('admin.beats.edit', compact('beat', 'genres'));
    }

    public function update(Request $request, Beat $beat)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'bpm' => 'nullable|integer|min:0',
            'duration' => 'nullable|string',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
            'audio_file' => 'nullable|file|mimes:mp3,wav|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,avif|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'trimmed_audio_file' => 'nullable|file|mimes:wav'
        ]);

        try {
            // Handle audio file upload
            if ($request->hasFile('audio_file')) {
                // Delete old audio file and preview
                if ($beat->file_url) {
                    Storage::delete($beat->file_url); // Using default disk (local/private)
                }
                if ($beat->preview_url) {
                    Storage::delete($beat->preview_url);
                }
                // Store the uploaded file in private storage
                $validated['file_url'] = $request->file('audio_file')->store('beats/audio');
                // Reset preview URL so it can be regenerated later
                $validated['preview_url'] = $request->file('trimmed_audio_file')->store('beats/previews');
            }
            

            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                // Delete old cover image
                if ($beat->cover_image) {
                    Storage::disk('public')->delete($beat->cover_image);
                }
                    $manager = new ImageManager(new Driver());
                    $file = $request->file('cover_image');
                    $filename = 'beats/covers/' . Str::random(20) . '.webp';
                    $image = $manager->read($file)->cover(500, 500)->toWebp(85);   
                    Storage::disk('public')->put($filename, (string) $image);
                    $validated['cover_image'] = $filename;
                
                // Extract and update color accent from new cover image
                try {
                    $validated['color_accent'] = $this->getDominantColor($request->file('cover_image'));
                } catch (\Exception $e) {
                    Log::error('Failed to extract color accent: ' . $e->getMessage());
                    $validated['color_accent'] = $beat->color_accent; // Keep existing color if extraction fails
                }
            }

            // Update beat
            $beat->update($validated);

            // Sync genres
            $beat->genres()->sync($validated['genre_ids']);

            return redirect()->route('admin.beats.index')
                ->with('success', 'Beat updated successfully.')
                ->with('preview_generation', $request->hasFile('audio_file'));

        } catch (\Exception $e) {
            Log::error('Failed to update beat: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Failed to update beat. Please try again.');
        }
    }

    public function destroy(Beat $beat)
    {
        try {
            // Delete associated files
            if ($beat->file_url) {
                Storage::delete($beat->file_url); // Deletes from the private storage
            }
            if ($beat->cover_image) {
                Storage::disk('public')->delete($beat->cover_image);
            }
            if ($beat->preview_url) {
                Storage::delete($beat->preview_url); // Deletes from the private storage
            }

            // Delete the beat record
            $beat->delete();

            return redirect()->route('admin.beats.index')
                ->with('success', 'Beat deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to delete beat: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete beat. Please try again.');
        }
    }
} 
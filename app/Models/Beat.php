<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'preview_url',
        'price',
        'bpm',
        'duration',
        'file_url',
        'preview_url',
        'cover_image',
        'color_accent',
        'is_sold',
        'is_featured',
        'status',
        'user_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_sold' => 'boolean',
        'is_featured' => 'boolean',
        'bpm' => 'integer',
    ];

    /**
     * Get the genres for the beat.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Get the user who owns the beat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users who have this beat in their wishlist.
     */
    public function wishlists()
    {
        return $this->belongsToMany(User::class, 'wishlist');
    }

    /**
     * Get the orders containing this beat.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Scope a query to only include featured beats.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include published beats.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

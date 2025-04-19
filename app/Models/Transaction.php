<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'beat_id',
        'reference',
        'amount',
        'currency',
        'status',
        'channel',
        'gateway_response',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // 🔗 Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beat()
    {
        return $this->belongsTo(Beat::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}

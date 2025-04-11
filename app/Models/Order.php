<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'beat_id', 'amount', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function beat() {
        return $this->belongsTo(Beat::class);
    }
}

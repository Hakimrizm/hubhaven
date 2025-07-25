<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user', 'place'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'place_id', 'place_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['partner'];

    public function partner(): BelongsTo {
        return $this->belongsTo(Partner::class);
    }

    public function imagePlaces(): HasMany {
        return $this->hasMany(ImagePlace::class);
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }

    public function bookings(): HasMany {
        return $this->hasMany(Booking::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('review_rating');
    }
}

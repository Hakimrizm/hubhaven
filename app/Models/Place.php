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

    public function imagePlace(): HasMany {
        return $this->hasMany(ImagePlace::class);
    }

    public function review(): HasMany {
        return $this->hasMany(Review::class);
    }
}

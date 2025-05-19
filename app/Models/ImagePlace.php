<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImagePlace extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['place'];

    public function Place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }
}

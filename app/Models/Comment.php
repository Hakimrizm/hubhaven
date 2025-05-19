<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['user', 'comment'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(Comment::class, 'comment_parent_id');
    }

    public function replies(): HasMany {
        return $this->hasMany(Comment::class, 'comment_parent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "image_path", "description"
    ];
    
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function comment(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function like(): HasMany {
        return $this->hasMany(Like::class);
    }
    
    public function getCreatedAtFormattedAttribute(): string {
        return \Carbon\Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }  
}

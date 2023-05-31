<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        "image_id"
    ];

    protected static function boot() {
        parent::boot();
        if(!app()->runningInConsole()){
            self::creating(function (Like $like) {
                $like->user_id = auth()->id();
            });
        }
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function image(): BelongsTo {
        return $this->belongsTo(Image::class);
    }
}

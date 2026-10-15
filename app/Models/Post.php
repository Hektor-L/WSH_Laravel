<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

#[Fillable(['title', 'description', 'poster_id', 'category_id', 'image_path'])]
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use SoftDeletes, HasFactory, Notifiable;
    
    public $timestamps = true;
    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'poster_id');
    }
    public function comments(): HasMany {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function categories(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

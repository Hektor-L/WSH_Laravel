<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use SoftDeletes, HasFactory, Notifiable;
    
    public $timestamps = true;
    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'commenter_id');
    }
    public function posts(): BelongsTo {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function parentComment(): BelongsTo {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }
    public function childComments(): HasMany {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }
}

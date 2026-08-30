<?php

namespace App\Models;

use Database\Factories\InterestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Interest extends Model
{
    /** @use HasFactory<InterestFactory> */
    use HasFactory, Notifiable;

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'interestedUser_id');
    }
    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'category_id');
    }

}

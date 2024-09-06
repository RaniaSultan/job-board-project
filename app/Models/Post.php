<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// to use many-many relationship
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'applications', 'post_id', 'user_id')->withPivot('resume', 'status')->withTimestamps();
    }
}


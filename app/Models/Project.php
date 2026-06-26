<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'status',
        'image',
        'sdgs',
        'author',
        'date',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function scopeOrderByPublished($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}

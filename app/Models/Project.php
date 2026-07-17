<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'status',
        'image',
        'sdgs',
        'author',
        'date',
        'published_at',
        'is_pinned',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_pinned'    => 'boolean',
    ];

    public function scopeOrderByPublished($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    public function getDisplayImageAttribute()
    {
        return $this->image ?: $this->images->first()?->image;
    }
}

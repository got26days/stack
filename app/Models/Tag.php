<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $dateFormat = 'd.m.Y';

    protected $appends = ['value'];

    public function getValueAttribute()
    {
        if ($this->attributes['tag_name']) {
            return $this->attributes['tag_name'];
        }
        return null;
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }
}

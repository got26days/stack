<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $appends = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Question::class, 'id', 'parent_id');
    }

    public function tagsRelationshipSecond()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_ansers', 'post_id', 'tag_id');
    }
}

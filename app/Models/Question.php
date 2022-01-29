<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $dateFormat = 'd.m.Y';

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
        'closed_date' => 'datetime',
        'last_edit_date' => 'datetime',
        'last_activity_date' => 'datetime',
        'community_owned_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->orderBy('created_at');
    }


    public function tagsRelationship()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function tagsRelationshipSecond()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_seconds', 'post_id', 'tag_id');
    }

    protected $appends = ['tagsArray'];

    public function getTagsArrayAttribute()
    {

        $tagsArray = [];


        if ($this->tags) {
            $array = explode('>', $this->tags);

            foreach ($array as $item) {
                if ($item != '') {
                    $tagsArray[] = str_replace("<", "", $item);
                }
            }
        }
        return $tagsArray;
    }
}

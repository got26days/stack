<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $appends = ['tagsArray'];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    // public function tagsRelationship()
    // {
    //     return $this->belongsToMany(Tag::class, 'post_tag_ansers', 'post_id', 'tag_id');
    // }

    // public function getTagsArrayAttribute()
    // {

    //     $tagsArray = [];


    //     if ($this->tags) {
    //         $array = explode('>', $this->tags);

    //         foreach ($array as $item) {
    //             if ($item != '') {
    //                 $tagsArray[] = str_replace("<", "", $item);
    //             }
    //         }
    //     }
    //     return $tagsArray;
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }


    public function tagsRelationship()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
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

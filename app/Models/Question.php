<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    // protected $dateFormat = 'd.m.Y';

    protected $casts = [
        // 'created_at' => 'datetime:d.m.Y',
        'closed_date' => 'datetime',
        'last_edit_date' => 'datetime',
        'last_activity_date' => 'datetime',
        'community_owned_date' => 'datetime',
    ];

    protected $fillable = [
        'title', 'body', 'score', 'tags', 'accepted_answer', 'answer_count',
        'comment_count', 'favorite_count', 'closed_date', 'community_owned_date',
        'last_activity_date', 'updated_at', 'created_at',
        'view_count', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->orderBy('created_at');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'parent_id', 'id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class, 'id', 'accepted_answer_id');
    }


    public function tagsRelationship()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function tagsRelationshipSecond()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_seconds', 'post_id', 'tag_id');
    }

    protected $appends = ['tagsArray', 'tagsString', 'desription'];

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

    public function getTagsStringAttribute()
    {

        $tagsArray = '';


        if ($this->tags) {
            $array = explode('>', $this->tags);

            foreach ($array as $key => $item) {
                if ($item != '') {
                    $sep = '';
                    if ($key != 0) {
                        $sep = ', ';
                    }
                    $tagsArray .= $sep . str_replace("<", "", $item);
                }
            }
        }
        return $tagsArray;
    }

    public function getDesriptionAttribute()
    {
        $string = $this->body;
        $string = strip_tags($string);
        $string = mb_strimwidth($string, 0, 240, '...');
        return $string;
    }
}

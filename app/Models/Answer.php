<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $appends = [];

    protected $fillable = [
        'body', 'score',
        'comment_count',
        'last_activity_date', 'updated_at', 'created_at',
        'seo_title', 'seo_description', 'seo_keywords', 'parent_id',
        'owner_user_id'
    ];

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

    public function tagsRelationship()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_ansers', 'post_id', 'tag_id');
    }
}

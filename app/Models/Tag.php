<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $dateFormat = 'd.m.Y';

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    protected $appends = ['value'];

    public function getValueAttribute()
    {
        if ($this->attributes['tag_name']) {
            return $this->attributes['tag_name'];
        }
        return null;
    }

    public function tagsRelationship()
    {
        return $this->belongsToMany(Question::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function tagsRelationshipSecond()
    {
        return $this->belongsToMany(Question::class, 'post_tag_seconds', 'post_id', 'tag_id');
    }
}

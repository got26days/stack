<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $appends = ['value'];

    public function getValueAttribute()
    {
        if ($this->attributes['tag_name']) {
            return $this->attributes['tag_name'];
        }
        return null;
    }
}

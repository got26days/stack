<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_name',
        'reputation',
        'name',
        'email',
        'password',
        'location',
        'about_me',
        'last_access_date',
        'website_url',
        'profile_image_url',
        'views', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $dateFormat = 'd.m.Y';
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_access_date' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'owner_user_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'owner_user_id', 'id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}

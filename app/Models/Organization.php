<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ["local_admin", "employees", "seminars", "social_activities", "image"];

    public function owner()
    {
        return $this->belongsTo(User::class)->role("host_admin");
    }

    public function local_admin()
    {
        return $this->hasOne(User::class)->role("local_admin");
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function seminars()
    {
        return $this->hasMany(Seminars::class);
    }

    public function social_activities()
    {
        return $this->hasMany(SocialActivity::class);
    }

    /**
     * Get the post's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, "imageable");
    }
}

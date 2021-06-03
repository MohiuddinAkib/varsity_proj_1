<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialActivity extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $guarded = [];

    protected $casts = [
        "volunteers" => "array"
    ];

    protected $cascadeDeletes = ["image"];

    public function setVolunteersAttribute($value)
    {
        $this->attributes["volunteers"] = json_encode($value);
    }

    public function getVolunteersAttribute($value)
    {
        return implode(", ", $value);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the post's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, "imageable");
    }
}

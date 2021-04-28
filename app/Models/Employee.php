<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, CascadeSoftDeletes;

    protected $cascadeDeletes = ["image"];

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

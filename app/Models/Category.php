<?php

namespace App\Models;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $fillable = ['name', 'slug'];
    public static function generateSlug($name)
    {
        return Str::slug($name, '-');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

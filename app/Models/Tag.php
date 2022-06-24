<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{   
    protected $fillable = ['name', 'slug'];
    public static function generateSlug($name)
    {
        return Str::slug($name, '-');
    }
    public function posts()
    {
        return $this->BelongsToMany(Post::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title','slug','image','text','date','description','posted','type','category_id'
    ];

    public function category() 
    {
        return $this->belonsTo(Category::class);

    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggables');
    }

 
}

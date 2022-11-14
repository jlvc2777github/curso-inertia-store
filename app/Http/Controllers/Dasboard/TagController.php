<?php

namespace App\Http\Controllers\Dasboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    protected $fillable = [
        'title','slug','image','text'
    ];
    public function posts()
    {
        $this->hasMany(Post::class);
        
    }

}

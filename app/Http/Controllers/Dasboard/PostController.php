<?php

namespace App\Http\Controllers\Dasboard;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    //
   public function index()
   {
       return Inertia::render('Dashboard/Post/index');
   }


}

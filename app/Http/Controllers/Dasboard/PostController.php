<?php

namespace App\Http\Controllers\Dasboard;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\Posts\Put;
use App\Http\Requests\Posts\Store;

class PostController extends Controller
{
    //
   public function index()
   {
      // return Inertia::render('Dashboard/Post/index');


        $posts = Post::paginate(5);
        return inertia('Dashboard/Post/index',compact('posts'));
   }

   public function create()
   {
        $categories = Category::get();
        return inertia('Dashboard/Post/Create',compact('categories'));
   }

   public function store(Store $request)
   {
        
        Post::create($request->validated());
        return to_route('post.index')->with('message','Create post successfully');
   }

   public function edit(Post $post)
   {
        $categories = Category::get();
        return inertia('Dashboard/Post/Edit',compact('post','categories'));
   }

   public function update(Put $request,Post $post)
   {
     $post->update($request->validated());
     return redirect()->route('post.index')->with('message','Updated post successfully');

   }
   public function destroy(Post $post)
   {
       
        $post->delete();
        return to_route('post.index')->with('message','Delete post successfully');
   }

}

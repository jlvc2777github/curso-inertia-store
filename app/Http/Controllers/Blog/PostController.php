<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{

    public function index()
    {
 
         //$posts = Post::where("id",">=",1);
         $categories = Category::get();
         $search=request('search');
         $posted=request('posted');
         $type=request('type');
         $from=request('from');
         $to=request('to');
         
 
         //$posts = Post::with('category')->orderBy($sortColumn,$sortDirection);
         $posts = Post::where('posted','yes');
 
          if(request('search')){
           $posts->where(function($query){
                $query->orWhere('id','like','%'.request('search').'%')
                ->orWhere('title','like','%'.request('search').'%')
                ->orWhere('description','like','%'.request('search').'%')
                ;
           });
         } 
 
         if(request('from') && request('to')){
           $posts->whereBetween('date',[date(request('from')),date(request('to'))]);
         }
 
         if(request('type')){
           $posts->where('type',request('type'));
         }
         if(request('category_id')){
           $posts->where('category_id',request('category_id'));
         }

         $posts = $posts->where('posted','yes')->paginate(10);
         return inertia('Blog/index',[
              'posts'=>$posts,
              'categories'=>$categories,
              'type'=>$type,
              'search'=>$search,
              'from'=>$from,
              'to'=>$to,
              ]);
    }

    public function show(Post $post)
    {
      // relacion
      //dd("show");
      $post->category;
      Inertia::share('step',getStep());
      return inertia('Blog/show',compact('post'));
    }
}

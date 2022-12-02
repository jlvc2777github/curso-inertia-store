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
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   public $columns = [
     'id'=>'Id',
     'title'=>'Title',
     'date'=>'Date',
     'description'=>'Description',
     'type'=>'Type',
     'category_id'=>'Category'
   ];
   public function index()
   {
      // return Inertia::render('Dashboard/Post/index');

        //$posts = Post::where("id",">=",1);
        $categories = Category::get();
        $search=request('search');
        $posted=request('posted');
        $type=request('type');
        $from=request('from');
        $to=request('to');
        
        $sortColumn=request('sortColumn') ?? 'id';
        $sortDirection=request('sortDirection') ?? 'asc' ;

        //$posts = Post::with('category')->orderBy($sortColumn,$sortDirection);
        $posts = Post::orderBy($sortColumn,$sortDirection);

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
        if(request('posted')){
          $posts->where('posted',request('posted'));
        }
        $posts = $posts->paginate(10);
        return inertia('Dashboard/Post/index',[
             'posts'=>$posts,
             'categories'=>$categories,
             'posted'=>$posted,
             'type'=>$type,
             'search'=>$search,
             'from'=>$from,
             'to'=>$to,
             'columns'=>$this->columns,
             'sortColumn'=>$sortColumn,
             'sortDirection'=>$sortDirection
             ]);
   }

   public function create()
   {
        $categories = Category::get();
        return inertia('Dashboard/Post/Create',compact('categories'));
   }

   public function store(Store $request)
   {
    //    dd($request['image']);

        $post = Post::create($request->validated());
        // agrega fotografia
        if($request->image){
            $this->upload($request,$post);
        }
       
        return to_route('post.index')->with('message','Create post successfully');
   }

   public function edit(Post $post)
   {
        $categories = Category::get();
        return inertia('Dashboard/Post/Edit',compact('post','categories'));
   }

   public function update(Put $request,Post $post)
   {
    //dd($request->image);
     $post->update($request->validated());
    // dd($request);
    if ($request->image){
        $this->upload($request,$post);
    }
    
     return redirect()->route('post.index')->with('message','Updated post successfully');

   }
   public function destroy(Post $post)
   {
       
        $post->delete();
        return to_route('post.index')->with('message','Delete post successfully');
   }

   public function upload(Request $request,Post $post)
   {
    
        $request->validate([
            "image"=>"required|mimes:png,jpg,jpeg,gif|max:10240"
        ]);

       // dd($request['image']);
        
        Storage::disk("public_upload")->delete("image/post/".$post->image);

        $data['image'] = $filename = time() . "." . $request['image']->extension();

        $request->image->move(public_path('image/post'),$filename);

        $post->update($data);

        return redirect()->route('post.index')->with('message','Updated image to post successfully');

   }
   public function imageDelete(Post $post)
   {
    Storage::disk("public_upload")->delete("image/post/".$post->image);
    $data['image'] ="";
    $post->update($data);
    return redirect()->route('post.edit',$post->id)->with('message','image removed successfully');

   }
}

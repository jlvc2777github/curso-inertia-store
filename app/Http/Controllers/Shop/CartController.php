<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\Post;

class CartController extends Controller
{
    public function index()
    {
        return inertia('Shop/Index');
        
    }
    public function add(Post $post,$count=1)
    {
        $cart=session('cart',[]);

/*         [
            18=>[post1,5],
            19=>[post2,2],
            35=>[post35,1],
        ] */

        // eliminar
        if($count <= 0){
            if(Arr::exists($cart,$post->id)){
                unset($cart[$post->id]);
                session(['cart'=>$cart]);
            }
            return redirect()->back();
        }

        $new_count = floatval($count);
         
        // agregar
        if(Arr::exists($cart,$post->id)){
            $cart[$post->id] =$new_count;
        }else{
            $cart[$post->id]=[$post,$count];
        }
        

        session(['cart'=>$cart]);
        return redirect()->back();
    }
}

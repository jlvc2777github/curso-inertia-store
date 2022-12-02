<?php

use App\Http\Controllers\Blog\PostController as BlogPostController;
use App\Http\Controllers\Dasboard\CategoryController;
use App\Http\Controllers\Dasboard\PostController;
use App\Http\Controllers\Contact\GeneralController;
use App\Http\Controllers\Contact\CompanyController;
use App\Http\Controllers\Contact\PersonController;
use App\Http\Controllers\Contact\DetailController;
use App\Http\Controllers\Shop\CartController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//Route::inertia('indexconinertia','Dashboard/Post/index');

//Route::get('/',[PostController::class,'index']);


Route::group(['middleware'=>[
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',   
]],function(){
    Route::resource('/category',CategoryController::class);
    Route::resource('/post',PostController::class);
    Route::post('/post/upload/{post}',[PostController::class,'upload'])->name('post.upload');
    Route::delete('/post/image/delete/{post}',[PostController::class,'imageDelete'])->name('post.image-delete');
});


Route::group(['middleware'=>[
  //  'prefix'=>'contact',
  /*   'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',  */  
]
],function(){
    Route::resource('contact-general',GeneralController::class)->only(['edit','create','store','update']);
    Route::resource('contact-company',CompanyController::class)->only(['edit','create','store','update']);
    Route::resource('contact-person',PersonController::class)->only(['edit','create','store','update']);
    Route::resource('contact-detail',DetailController::class)->only(['edit','create','store','update']);

});


Route::group([
    'prefix'=>'blog',
  ],function(){
      Route::get('/',[BlogPostController::class,'index'])->name('web.index');
      Route::get('/{post:slug}',[BlogPostController::class,'show'])->name('web.show');
    //  Route::get('/{id}',[BlogPostController::class,'show'])->name('web.show');
  });


  Route::group([
    'prefix'=>'shop',
  ],function(){
      Route::get('/',[CartController::class,'index'])->name('shop.index');
      Route::post('/add/{post}/{count}',[CartController::class,'add'])->name('shop.add');
  });

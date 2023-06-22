<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class,'home'])->name('home');;
//return view without variable method
//Route::view('/','home.index');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::get('/single', AboutController::class)->name('about');

$posts = [
    1 => [
        'title'   => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new'  => true,
        'has_comments'  => true,
    ],
    2 => [
        'title'   => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new'  => false
    ],
    3=> [
        'title'   => 'Intro to GoLang',
        'content' => 'This is a short intro to GoLang',
        'is_new'  => false
    ],
    4=> [
        'title'   => 'Intro to .NET',
        'content' => 'This is a short intro to .NET',
        'is_new'  => false
    ],

];
Route::resource('/posts', PostController::class)->only(['index','show','create','store']);
//Route::resource('/posts', PostController::class)->only(['index','show']);
//Route::resource('/posts', PostController::class)->except(['index','show']);

//Route::get('/posts', function () use($posts) {
////    $request in Request class OR bottom helper
////    request()->all();
////    request()->input('page' , 1 );
////    request()->query('page',1);
////    request()->boolean('variable1'); // consist: "yes" , "on" , 1 , "1"
////    request()->only(['variable1','variable2']);
////    request()->except(['variable1','variable2']);
////    request()->has('variable1');
////    request()->hasAny(['variable1','variable2']);// if any of  array is sent
////    request()->filled('variable1');// if isset and not empty
//
//    return view('posts.index',['posts'=>$posts]);
//});
//
//Route::get('/post/{id}', function ($id) use($posts) {
//    abort_if(!isset($posts[$id]),404);
//    return view('posts.show',['post'=>$posts[$id]]);
//})->name('posts.show');

// group with url
Route::prefix('/func')->name('func.')->group(function() use($posts){
    Route::get('/response',function () use($posts){
        return response($posts, 200 )
            ->header('Content-Type','application/json')
            ->cookie('My_Cookie','Cookie for response' , 3600);
    })->name('response');

    Route::get('/redirect',function () use($posts){
        return redirect('/contact');
    })->name('redirect');

    Route::get('/back',function () use($posts){
        return back();
    })->name('back');

    Route::get('/named-route',function () use($posts){
        return redirect()->route('posts.show', ['id' =>2]);
    })->name('redirectToRoute');

    Route::get('/away',function (){
//    redirect to another domain of my app site
        return redirect()->away('https://google.com');
    })->name('away');

    Route::get('/json',function () use($posts){
        return response()->json($posts);
    })->name('json');

    Route::get('/download',function () use($posts){
        return response()->download(public_path('/img/ax.jpg'),'Download_name');
    })->name('download');
});

Route::get('/param/{id_pattern}', function ($id) {
    echo $id;
});

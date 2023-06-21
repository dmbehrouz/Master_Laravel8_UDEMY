<?php

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

Route::get('/', function () {
    return view('home.index',[]);
});
//Same above code
Route::view('/','home.index');


Route::get('/contact', function () {
    return view('home.contact');
});
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
Route::get('/posts', function () use($posts) {
    return view('posts.index',['posts'=>$posts]);
});

Route::get('/post/{id}', function ($id) use($posts) {
    abort_if(!isset($posts[$id]),404);
    return view('posts.show',['post'=>$posts[$id]]);
});

Route::get('/param/{id_pattern}', function ($id) {
    echo $id;
});

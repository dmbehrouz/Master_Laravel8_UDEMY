<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['contact','query_test']);
    }

    public function index()
    {
//        dd(Auth::user   ());
        return view('home.index');
    }

    public function query_test()
    {
        // talke method used for define count of retrieve record
//        return view('posts.index', ['posts' => BlogPost::orderBy('created_at','desc')->take(5)->get()]);

        //Log Query
        DB::connection()->enableQueryLog();
        // Lazy load
//        $posts = BlogPost::all();
//        foreach ($posts as $post){
//            foreach ($post->comments as $comment){
//                echo $comment->content;
//            }
//        }
        // Eager load
//        BlogPost::with('comments');
        // count relations
        // BlogPost::withCount('comments')->get(); //add comments_count field in every record
//        $posts = BlogPost::withCount(['comments','comments as new_comments' => function($query){
//            $query->where('created_at','>','2023-06-25 19:14:31');
//        }])->get();//Add new_comments field to response every record
//        dd($posts->toArray());
        // If we want to see all related records we need like this; $author->profile
//        $author = new Author();
//        $test = $author->find(1);
//        dd($test->profile()->get()->toArray());
//        dd(DB::getQueryLog());
        return view('home.index');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function secret()
    {
        return view('home.secret');
    }
}

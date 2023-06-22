<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
//    private $posts = [
//        1 => [
//            'title' => 'Intro to Laravel',
//            'content' => 'This is a short intro to Laravel',
//            'is_new' => true,
//            'has_comments' => true,
//        ],
//        2 => [
//            'title' => 'Intro to PHP',
//            'content' => 'This is a short intro to PHP',
//            'is_new' => false
//        ],
//        3 => [
//            'title' => 'Intro to GoLang',
//            'content' => 'This is a short intro to GoLang',
//            'is_new' => false
//        ],
//        4 => [
//            'title' => 'Intro to .NET',
//            'content' => 'This is a short intro to .NET',
//            'is_new' => false
//        ],
//
//    ];


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        // talke method used for define count of retrieve record
//        return view('posts.index', ['posts' => BlogPost::orderBy('created_at','desc')->take(5)->get()]);
        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id)
    {
        // No need to this line because findOrFail do same that action
        // abort_if(!isset($this->posts[$id]), 404);
        return view('posts.show', ['post' => BlogPost::findOfFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

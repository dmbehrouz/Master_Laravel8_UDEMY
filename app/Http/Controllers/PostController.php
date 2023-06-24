<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
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
     * @return View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
//        one way to validation with Request class
//        $request->validate([
//            'title' => 'bail|required|min:5|max:10',
//            'content' => 'required|min:10',
//        ]);
        $validate = $request->validated();
//        $post = new BlogPost();
//        $post->title = $validate['title'];
//        $post->content = $validate['content'];
//        $post->save();
//        Mass assignment save
        $post = BlogPost::create($validate);
        // flush message save in session
        $request->session()->flash('status','The blog post is created!');
        return redirect()->route('posts.show', ['post' => $post->id]);
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
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id)
    {
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return View
     */
    public function update(StorePost $request, $id)
    {
//        dd($request);
        $post = BlogPost::findOrFail($id);
        $validate = $request->validated();
        $post->fill($validate);
        $post->save();

        $request->session()->flash('status','The Post id '.$id. ' updated');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return View
     */
    public function destroy($id)
    {
       $post = BlogPost::findOrFail($id);
       $post->delete();
        //use session  helper
       session()->flash('status','The Post id '.$id. ' Deleted');
       return redirect()->route('posts.index');
    }
}

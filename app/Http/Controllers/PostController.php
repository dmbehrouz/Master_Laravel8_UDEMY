<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'destroy', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        // talke method used for define count of retrieve record
//        return view('posts.index', ['posts' => BlogPost::orderBy('created_at','desc')->take(5)->get()]);

        //Log Query
//        DB::connection()->enableQueryLog();
        // Lazy load
//        $posts = BlogPost::all();
//        foreach ($posts as $post){
//            foreach ($post->comments as $comment){
//                echo $comment->content;
//            }
//        }
        // Eager load
//        BlogPost::with('comments');
//        dd(DB::getQueryLog());
        $params = [
            //Use scope instead add orderBy repeat.
            // take add limit to query
            'posts' => BlogPost::reorderShow()->withCount('comments')->get(),
            'most_commented' => BlogPost::mostCommented()->take(5)->get(),
            'most_active' => User::withMostBlogPosts()->take(5)->get(),
            'most_active_last_month' => User::withMostBlogPostsLastMonth()->take(5)->get(),
        ];
//        dd(DB::getQueryLog());
        return view('posts.index',$params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //Because laravel map methods of policy class  to exist method in crud
        $this->authorize('create');
        BlogPost::whereHas('comments', function ($query) {
            $query->where('content', 'like', '%Create%');
        })->get();

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
        //Get user id
        $validate['user_id'] = $request->user()->id;
//        $post = new BlogPost();
//        $post->title = $validate['title'];
//        $post->content = $validate['content'];
//        $post->save();
//        Mass assignment save
        $post = BlogPost::create($validate);
        // flush message save in session
        $request->session()->flash('status', 'The blog post is created!');
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
        return view('posts.show', [
             'post' => BlogPost::with('comments')->findOrFail($id),
            // Call scope like static method.
            //Add local query inline. this sub query for inside join used
//            'post' => BlogPost::with(['comments' => function($query){
//                return $query->reorderShowComment();
//            }])->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id)
    {
        $post = BlogPost::findOrFail($id);
//        if( Gate::denies('update-post', $post) ){
//            abort(403, 'You are not permission HONEY ;)');
//        }
        // We should this helper instead above lines(Gate facade)
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => $post ]);
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
//        if( Gate::denies('posts.update', $post) ){
//            abort(403, 'You are not permission HONEY ;)');
//        }
        // OR use this
        $this->authorize('update', $post);
        $validate = $request->validated();
        $post->fill($validate);
        $post->save();

        $request->session()->flash('status', 'The Post id ' . $id . ' updated');
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
        $this->authorize('delete',$post);
        $post->delete();
        //use session  helper
        session()->flash('status', 'The Post id ' . $id . ' Deleted');
        return redirect()->route('posts.index');
    }
}

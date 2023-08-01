<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

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
        // take method used for define count of retrieve record
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

        $mostCommented = Cache::tags(['blog-post'])->remember('blog-post-commented', 60, function () {
            return BlogPost::mostCommented()->take(5)->get();
        });

        $mostActive = Cache::remember('users-most-active', 60, function () {
            return User::withMostBlogPosts()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::remember('users-most-active-last-month', 60, function () {
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });
        $params = [
            //Use scope instead add orderBy repeat.
            // take add limit to query
            'posts' => BlogPost::reorderShow()->withCount('comments')->get(),
            'most_commented' => $mostCommented,
            'most_active' => $mostActive,
            'most_active_last_month' => $mostActiveLastMonth,
        ];
//        dd(DB::getQueryLog());
        return view('posts.index', $params);
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

        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use ($id) {
            return BlogPost::with('comments')->findOrFail($id);
        });

        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";
        $users = Cache::tags(['blog-post'])->get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->forever($usersKey,$usersUpdate);
        if(Cache::tags(['blog-post'])->has($counterKey)){
            Cache::tags(['blog-post'])->forever($counterKey,1);
        }else{
            Cache::tags(['blog-post'])->increment($counterKey,$difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return view('posts.show', [
            'post' => $blogPost,
            'counter' => $counter,
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

        return view('posts.edit', ['post' => $post]);
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
        $this->authorize('delete', $post);
        $post->delete();
        //use session  helper
        session()->flash('status', 'The Post id ' . $id . ' Deleted');
        return redirect()->route('posts.index');
    }
}

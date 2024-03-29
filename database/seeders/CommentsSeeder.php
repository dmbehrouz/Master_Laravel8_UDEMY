<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();

        Comment::factory(20)->make()->each(function ($comment) use ($posts){
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}

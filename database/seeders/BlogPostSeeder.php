<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        //each is a method of collection in laravel
        BlogPost::factory(10)->make()->each(function ($post) use ($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}

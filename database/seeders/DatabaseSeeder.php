<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeding with factory
        // \App\Models\User::factory(10)->create();
        // Seeding manual

        //        DB::table('users')->insert([
        //            'name' => 'behrouz dmohammadi',
        //            'email' => 'dmbehrouz@gmail.com',
        //            'email_verified_at' => now(),
        //            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //            'remember_token' => Str::random(10),
        //        ]);

        $this->call([
            UserSeeder::class,
            BlogPostSeeder::class,
            CommentsSeeder::class
        ]);

    }
}

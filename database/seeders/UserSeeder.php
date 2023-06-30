<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Return collections
//        $users = User::factory(4)->create();
        // Return model class
//        $myUser = User::factory()->my_email()->create();
        // Concat two Collection with a model
//        $users = $users->concat([$myUser]);

        User::factory(4)->create();
        User::factory()->my_email()->create();


    }
}

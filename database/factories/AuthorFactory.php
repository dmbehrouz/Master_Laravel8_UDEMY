<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        // First argument must instance of current model class
//        return $this->afterMaking(function (Author $author) {
//            //
//        });

        // First argument must instance of current model class
        return $this->afterCreating(function (Author $author, $faker) {
            // Add relations between created new author and profile
            // For this example  we should make method because we dont need save record after create with model
            $author->profile()->save(Profile::factory()->make());
        });
    }
}

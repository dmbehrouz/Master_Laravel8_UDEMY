<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
//    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'content' => $this->faker->sentence(5),
            'created_at' => $this->faker->dateTimeBetween('-3 month')
        ];
    }

    /**
     * @description This is state factory method for specific data record
     * @return BlogPostFactory
     */
    public function new_title()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'State method for specific field',
            ];
        });
    }
}

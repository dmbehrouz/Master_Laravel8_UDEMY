<?php

namespace Tests\Feature;

use App\Models\Comment;
use Database\Factories\BlogPostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Facade;
use Tests\TestCase;
use App\Models\BlogPost;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_see_1_blog_post_with_count()
    {
        //Arrange
        $post = $this->createDummyBlogPost();
//        Make factory with 3 records
        Comment::factory()->count(3)->create([
            'blog_post_id' => $post->id
        ]);
        //Act
        $response = $this->get('/');
        $response->assertSeeText('3 comments');
    }

    private function createDummyBlogPost()
    {
//        $post = new BlogPost();
//        $post->title = 'New title';
//        $post->content = 'Content of the blog post';
//        $post->save();
//        return $post;
        // Use state factory
        return BlogPost::factory()->new_title()->create();
    }

}

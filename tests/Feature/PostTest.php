<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\BlogPost;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts yet');
        $response->assertStatus(200);
    }

    public function testsSeeBlogPostWhenThereIsOne() 
    {
        $post = new BlogPost();
        $post->title = "New Post";
        $post->content = "This is the content";
        $post->save();

        $response = $this->get('/posts');

        $response->assertSeeText('New Post');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Post'
        ]);

        $response->assertStatus(200);
    }
}

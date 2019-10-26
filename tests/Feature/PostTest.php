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
        $post = $this->createBlogPost();

        $response = $this->get('/posts');

        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);

        $response->assertStatus(200);
    }

    public function testStoreValueIsValid()
    {
        $values = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $values)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was created!');
    }

    public function testStoreFail()
    {
        $values = [
            'title' => 'N',
            'content' => 'N'
        ];

        $this->post('/posts', $values)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $post = $this->createBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $values = [
            'title' => 'Updated title',
            'content' => 'Updated content for post'
        ];

        $this->put("/posts/{$post->id}", $values)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Updated title',
            'content' => 'Updated content for post'
        ]);
    }

    public function testUpdateFail()
    {
        $post = $this->createBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());
        
        $values = [
            'title' => 'N',
            'content' => 'N'
        ];

        $this->put("/posts/{$post->id}", $values)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testDelete()
    {
        $post = $this->createBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
            
        $this->assertEquals(session('status'), 'Blog post was deleted!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    private function createBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content for the post';
        $post->save();

        return $post;
    }
}

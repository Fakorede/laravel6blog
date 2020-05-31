<?php

namespace App\Observers;

use App\BlogPost;
use Illuminate\Support\Facades\Cache;

class BlogPostObserver
{
    /**
     * Handle the blog post "updating" event.
     *
     * @param  \App\BlogPost  $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    }

    /**
     * Handle the blog post "deleting" event.
     *
     * @param  \App\BlogPost  $blogPost
     * @return void
     */
    public function deleting(BlogPost $blogPost)
    {
        $blogPost->comments()->delete();
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    }

    /**
     * Handle the blog post "restoring" event.
     *
     * @param  \App\BlogPost  $blogPost
     * @return void
     */
    public function restoring(BlogPost $blogPost)
    {
        $blogPost->comments()->restore();
    }

}

<?php

namespace App\Listeners;

use App\Events\BlogPostPosted;
use App\Jobs\ThrottleMail;
use App\Mail\BlogPostAdded;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminWhenBlogPostCreated
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogPostPosted $event)
    {
        User::IsAnAdmin()->get()
            ->map(function (User $user) {
                ThrottleMail::dispatch(
                    new BlogPostAdded(),
                    $user
                );
            });
    }
}

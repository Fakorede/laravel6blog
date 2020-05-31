<?php

namespace App\Listeners;

use App\Jobs\ThrottleMail;
use App\Events\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\Jobs\NotifyUsersWhenPostCommented;

class NotifyUsersAboutComment
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        ThrottleMail::dispatch(
            new CommentPostedMarkdown($event->comment), 
            $event->comment->commentable->user
        )->onQueue('high');

        NotifyUsersWhenPostCommented::dispatch($event->comment)
            ->onQueue('low');
    }
}

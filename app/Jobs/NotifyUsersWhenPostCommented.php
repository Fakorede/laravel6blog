<?php

namespace App\Jobs;

use App\Comment;
use App\Mail\CommentPostedOnPostWatch;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyUsersWhenPostCommented implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $comment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::thatHasCommentedOnPost($this->comment->commentable)
            ->get()
            ->filter(function (User $user) {
                return $user->id !== $this->comment->user_id;
            })
            ->map(function (User $user) {
                ThrottleMail::dispatch(
                    new CommentPostedOnPostWatch($this->comment, $user),
                    $user
                );
                // Mail::to($user)->send(
                //     new CommentPostedOnPostWatch($this->comment, $user)
                // );
            });
    }
}

<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersWhenPostCommented;
use App\Jobs\ThrottleMail;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        // Mail::to($post->user)->send(
        //     // new CommentPosted($comment)
        //     new CommentPostedMarkdown($comment)
        // );
        // $when = now()->addMinutes(1);
        // Mail::to($post->user)->later(
        //     $when,
        //     new CommentPostedMarkdown($comment)
        // );

        // Mail::to($post->user)->queue(
        //     new CommentPostedMarkdown($comment)
        // );

        ThrottleMail::dispatch(new CommentPostedMarkdown($comment), $post->user)
            ->onQueue('high');

        NotifyUsersWhenPostCommented::dispatch($comment)
            ->onQueue('low');

        return redirect()->back()
            ->withStatus('Comment was added');
    }
}

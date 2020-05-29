<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<p>Hi {{ $comment->commentable->user->name }},</p>

<p>
    You have a new comment on your blog post.
    <a href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">
        {{ $comment->commentable->title }}
    </a>
</p>

<hr>

<p>
    {{-- $message->embed($comment->user->image->url()) --}}
    <img src="{{ $message->embed(storage_path('app/public') . '/' . $comment->user->image->path) }}">
    <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">
    {{ $comment->user->name }}</a>
</p> commented:

<p>
    "{{ $comment->content }}"
</p>
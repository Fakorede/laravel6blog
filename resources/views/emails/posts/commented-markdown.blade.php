@component('mail::message')
# New comment on your blog post.

Hi {{ $comment->commentable->user->name }},

Someone has made a new comment on your blog post.

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id]) ])
View the Post
@endcomponent

@component('mail::button', ['url' => $comment->user->id ])
View {{ $comment->user->name }} profile
@endcomponent

@component('mail::panel')
    {{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

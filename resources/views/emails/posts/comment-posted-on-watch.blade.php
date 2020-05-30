@component('mail::message')
# New comment on a blog post you're watching.

Hi {{ $user->name }},

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id]) ])
View the Post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id]) ])
View {{ $comment->user->name }} profile
@endcomponent

@component('mail::panel')
    {{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

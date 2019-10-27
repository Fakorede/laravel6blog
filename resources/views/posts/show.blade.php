@extends('layout')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p>Added: {{ $post->created_at->diffForHumans() }}</p>

    @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
        This is a new post!
    @endif

    <h3>Comments</h3>
    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}<sup class="text-muted"> added {{ $comment->created_at->diffForHumans() }}</sup> 
        </p>
    @empty
        <p>No comments yet</p>
    @endforelse
@endsection
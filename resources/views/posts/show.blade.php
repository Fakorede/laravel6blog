@extends('layout')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p>Added: {{ $post->created_at->diffForHumans() }}</p>

    @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
        This is a new post!
    @else
        Not new
    @endif
@endsection
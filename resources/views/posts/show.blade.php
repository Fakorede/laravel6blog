@extends('layout')

@section('content')
    <h1>
        {{ $post->title }}

        @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
            New
        @endbadge

    </h1>
    <p>{{ $post->content }}</p>
    {{-- <p>Added: {{ $post->created_at->diffForHumans() }}</p> --}}
    @updated(['date' => $post->created_at, 'name' => $post->user->name])
    @endupdated
    @updated(['date' => $post->updated_at])
        Updated
    @endupdated

    <h3>Comments</h3>
    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}
            {{-- <sup class="text-muted"> added {{ $comment->created_at->diffForHumans() }}</sup> --}}
            @updated(['date' => $comment->created_at])
            @endupdated 
        </p>
    @empty
        <p>No comments yet</p>
    @endforelse
@endsection
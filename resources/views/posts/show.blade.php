@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">
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

        @tags(['tags' => $post->tags])
        @endtags

        <p>Currently read by {{ $counter }} people</p>

        <h3>Comments</h3>

        @include('comments._form')

        @forelse($post->comments as $comment)
            <p>
                {{ $comment->content }}
                --}}
                @updated(['date' => $comment->created_at])
                @endupdated 
            </p>
        @empty
            <p>No comments yet</p>
        @endforelse
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection
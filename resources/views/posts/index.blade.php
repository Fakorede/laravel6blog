@extends('layout')

@section('content')
    @forelse($posts as $post)
        <p>
            <h3>
                <a href="{{ route('posts.show', [ 'post' => $post->id ]) }}">{{ $post->title }}</a>
                <h6 class="text-muted">
                    Added: {{ $post->created_at->diffForHumans() }} 
                    by {{ $post->user->name }}
                </h6>
            </h3>

            @if($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
            @else
                <p>No comments yet!</p>
            @endif

            @can('update', $post)  
                <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
            @endcan

            @can('delete', $post)
                <form class="fm-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <input class="btn btn-primary" type="submit" value="Delete">
                </form>
            @endcan
        </p>
    @empty
        <p>No posts yet</p>
    @endforelse
@endsection
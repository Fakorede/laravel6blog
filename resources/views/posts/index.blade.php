@extends('layout')

@section('content')
    <div class="row">
        <div class="col-8">
            
            @forelse($posts as $post)
                <p>
                        
                    <h3>

                        @if ($post->trashed())
                            <del>
                        @endif

                        <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                        href="{{ route('posts.show', [ 'post' => $post->id ]) }}">{{ $post->title }}</a>

                        @if ($post->trashed())
                        </del>
                        @endif

                    </h3>

                    {{-- <p class="text-muted">
                        Added: {{ $post->created_at->diffForHumans() }} 
                        by {{ $post->user->name }}
                    </p> --}}

                    @updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])
                    @endupdated

                    @tags(['tags' => $post->tags])
                    @endtags   
    
                    @if($post->comments_count)
                        <p>{{ $post->comments_count }} comments</p>
                    @else
                        <p>No comments yet!</p>
                    @endif
    
                    @auth
                        @can('update', $post)  
                            <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                                Edit
                            </a>
                        @endcan
                    @endauth
                    
    
                    @auth
                        @if (!$post->trashed())
                            @can('delete', $post)
                                <form class="fm-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <input class="btn btn-primary" type="submit" value="Delete">
                                </form>
                            @endcan 
                        @endif
                    @endauth
                    
                    
                </p>
            @empty
                <p>No posts yet</p>
            @endforelse
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
    
@endsection
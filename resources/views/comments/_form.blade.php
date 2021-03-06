<div class="mb-2 mt-2">
    @auth
        <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="post">
            @csrf

            <div class="form-group">
                <textarea type="text" name="content" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary btn-block" type="submit">Add Comment</button>
        </form>

        @errors @enderrors
    @else
        <a href="{{ route('login') }}">Sign-in</a> to post comments!
    @endauth
</div>

<hr>

@extends('layout')

@section('content')
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
    @csrf
    @method('PUT')

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}">
    </p>
    <p>
        <label for="content">Content</label>
        <input type="text" name="content" value="{{ old('content', $post->content) }}">
    </p>

    <button type="submit">Update</button>
</form>
@endsection
@extends('layout')

@section('content')
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('posts._form')

    <button class="btn btn-primary btn-block" type="submit">Update</button>
</form>
@endsection
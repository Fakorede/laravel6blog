@extends('layout')

@section('content')
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('posts._form')

        <button class="btn btn-primary btn-block" type="submit">Create</button>
    </form>
@endsection
@extends('layout')

@section('content')
    <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
        <input class="form-control" name="name" value="{{ old('name') }}" type="text" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" value="{{ old('name') }}" type="text" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" name="password" type="password" required>
        </div>
        <div class="form-group">
            <label for="confirm password">Confirm Password</label>
            <input class="form-control" name="password_confirmation" type="password" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Register</button>
    </form>
@endsection
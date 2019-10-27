@extends('layout')

@section('content')
    <form action="{{ route('register') }}" method="post" novalidate>
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" type="text" required>

            @if($errors->has('name'))
                <span class="invalid-feedback"></span>
                <strong>{{ $errors->first('name') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" type="text" required>

            @if($errors->has('email'))
                <span class="invalid-feedback"></span>
                <strong>{{ $errors->first('email') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" type="password" required>

            @if($errors->has('password'))
                <span class="invalid-feedback"></span>
                <strong>{{ $errors->first('password') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="confirm password">Confirm Password</label>
            <input class="form-control" name="password_confirmation" type="password" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Register</button>
    </form>
@endsection
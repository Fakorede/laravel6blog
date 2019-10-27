@extends('layout')

@section('content')
    <form action="{{ route('login') }}" method="post" novalidate>
        @csrf
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
            <div class="form-check">
                <input name="remember" type="checkbox" class="form-check-input" value="{{ old('remember') ? 'checked' : '' }}">
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>
        </div>
        
        <button class="btn btn-primary btn-block" type="submit">Login</button>
    </form>
@endsection
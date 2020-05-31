@extends('layout')

@section('content')
    <h1>{{ __('Contact') }}</h1>
    <p>{{ __('Hello this is contact!') }}</p>

    @can('home.secret')
        <a href="{{  route('secret') }}">
            Click to view Contact details
        </a>
    @endcan
@endsection
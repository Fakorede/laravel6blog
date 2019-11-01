@extends('layout')

@section('content')
    <h1>Contact</h1>
    <p>Contact us</p>

    @can('home.secret')
        <a href="{{  route('secret') }}">
            Click to view Contact details
        </a>
    @endcan
@endsection
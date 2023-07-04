@extends('layouts.app')
@section('title','Contact')
@section('content')
    <h1>CONTACT PAGE</h1>
    @can('middleware-gate')
        <p><a href="{{ route('secret') }}">Special Secret For Admin</a></p>
    @endcan
    <p>Hello this is contact page</p>
@endsection

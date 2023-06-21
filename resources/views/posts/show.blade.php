@extends('layouts.app')
@section('title', $post['title'])
@section('content')
    @if($post['is_new'])
        <div>if statement</div>
    @elseif(!$post['is_new'])
        <div>elseif statement</div>
    @else
        <div>else statement</div>
    @endif

    @unless($post['is_new'])
        <div>unless directive - only check if value is false </div>
    @endunless

    @isset($post['has_comments'])
        <div>isset directive - like isset in php</div>
    @endisset
    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>
@endsection

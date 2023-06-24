@extends('layouts.app')
@section('title', $post['title'])
@section('content')

    {{--    this lines for tutorial :) --}}
    {{--    @if($post['is_new'])--}}
    {{--        <div>if statement</div>--}}
    {{--    @elseif(!$post['is_new'])--}}
    {{--        <div>elseif statement</div>--}}
    {{--    @else--}}
    {{--        <div>else statement</div>--}}
    {{--    @endif--}}
    {{--    @unless($post['is_new'])--}}
    {{--        <div>unless directive - only check if value is false </div>--}}
    {{--    @endunless--}}
    {{--    @isset($post['has_comments'])--}}
    {{--        <div>isset directive - like isset in php</div>--}}
    {{--    @endisset--}}
    {{--    this lines for tutorial :) --}}

    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    {{-- diffforhuman used in carbon class--}}
    <p>added {{ $post->created_at->diffForHumans() }}</p>

    @if(now()->diffInMinutes($post->created_at) < 5 )
        <div class="alert alert-info">NEW POST!</div>
    @endif
@endsection

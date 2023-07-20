@extends('layouts.app')
@section('title', $post['title'])
@php($params['name'] = $post->user->name)
@php($params['date'] = $post->created_at)
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

    <h3>
        {{ $post->title }}
            @php($newPostCreated = now()->diffInMinutes($post->created_at) < 30)
{{--        @dd(now()->diffInMinutes($post->created_at))--}}
            {{-- This variable is addetional value into compnent   --}}
            <x-badge type="primary" :checkNewPost="$newPostCreated">
                {{-- This variable is fill into $slot component   --}}
                New Post Created!
            </x-badge>
    </h3>
    <p>{{ $post->content }}</p>

    <x-updateComment :params="$params" />
    @if(!empty($post->updated_at))
        @php($params['dateUpdate'] = $post->updated_at)
        @unset($params['name'])
        <x-updateComment :params="$params" >
            Updated
        </x-updateComment>
    @endif

    <h4>Comments HAAAAAAA</h4>
    @forelse($post->comments as $comment)
        <p>{{  $comment->content }}</p>
{{--        <p class="text-muted">--}}
{{--            {{ $comment->created_at->diffForHumans() }}--}}
{{--        </p>--}}
        <x-updateComment :params="$params" />
    @empty
        <p>No comment yet!</p>
    @endforelse
@endsection

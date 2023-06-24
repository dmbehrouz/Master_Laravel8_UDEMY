@extends('layouts.app')
@section('title', 'Blog Posts')
@section('content')
    {{--   @foreach($posts as $key => $post)--}}
    {{--This for check if array is empty--}}
    {{--@each('partials path',$array($posts), $variable for each array index($post))--}}
    {{--in @each() directive we dont intheritance variable in partials page--}}
    @forelse($posts as $key => $post)
        {{-- $loop exist in every loop directive and we get some property like even/odd/first,... --}}
        {{-- all variable in include file inheritance from where that call   --}}
        @include('posts.partials.post',['variable'=> ' _ '])
    @empty
        <div>No Post Here</div>
        {{--    @endforeach--}}
    @endforelse
@endsection

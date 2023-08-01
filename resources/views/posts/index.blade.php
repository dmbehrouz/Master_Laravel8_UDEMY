@extends('layouts.app')
@section('title', 'Blog Posts')
@section('content')
    {{--   @foreach($posts as $key => $post)--}}
    {{--This for check if array is empty--}}
    {{--@each('partials path',$array($posts), $variable for each array index($post))--}}
    {{--in @each() directive we dont intheritance variable in partials page--}}
    <div class="row">
        <div class="col-8">
            @forelse($posts as $key => $post)
                {{-- $loop exist in every loop directive and we get some property like even/odd/first,... --}}
                {{-- all variable in include file inheritance from where that call   --}}
                @include('posts.partials.post',['variable'=> ' _ '])
            @empty
                <div>No Post Here</div>
                {{--    @endforeach--}}
            @endforelse
        </div>
        <div class="col-4">
            <div class="container">
                <div class="row">
                    <x-card title="Most Commented" subTitle="What people are currently talking about">
                        <x-slot name="items">
                            @foreach($most_commented as $post)
                                <li class="list-group-item"><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></li>
                            @endforeach
                        </x-slot>
                    </x-card>
                </div>
                <div class="row mt-4">
                    <x-card title="Most Actives" subTitle="Users with most posts written "
                            :items="collect($most_active)->pluck('name')"/>
                </div>

                <div class="row mt-4">
                    <x-card title="Most Actives Last Month" subTitle="Users with most posts written in the last month "
                            :items="collect($most_active_last_month)->pluck('name')"/>
                </div>
            </div>
        </div>
    </div>
@endsection

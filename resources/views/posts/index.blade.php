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
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <p class="card-text text-muted mb-2">What people are currently talking about </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_commented as $post)
                                <li class="list-group-item"><a
                                        href="{{ route('posts.show',['post'=>$post->id]) }}">{{ $post->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most Actives</h5>
                            <p class="card-text text-muted mb-2">Users with most posts written </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_active as $user)
                                <li class="list-group-item">{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most Actives Last Month</h5>
                            <p class="card-text text-muted mb-2">Users with most posts written in the last month </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_active_last_month as $user)
                                <li class="list-group-item">{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

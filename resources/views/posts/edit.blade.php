 @extends('layouts.app')
@section('title', 'Edit the post')

@section('content')
    <form action="{{ route('posts.update' , $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div>
            <input type="submit" value="Edit" class="btn btn-primary btn-block">
        </div>
    </form>
@endsection

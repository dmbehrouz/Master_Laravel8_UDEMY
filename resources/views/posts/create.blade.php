@extends('layouts.app')
@section('title', 'Create the post')

@section('content')
<form action="{{ route('posts.store')  }}" method="POST">
    @csrf
{{--  old is a helper that use session to hold previous value of input  --}}
    <div><input type="text" name="title" value="{{old('title')}}"></input></div>
    {{-- $error directive show one valivation request with $message variable --}}
    @error('title')
        <div>{{$message}}</div>
    @enderror
    <div><textarea name="content">{{old('content')}}</textarea></div>
{{-- $errors object with ShareErrorsFromSession::class hold all errors in session  --}}
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error  }}</li>
            @endforeach
        </ul>
    @endif
    <div><input type="submit" value="Create"></input></div>
</form>
@endsection

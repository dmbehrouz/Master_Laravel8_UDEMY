<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script src="{{mix('js/app.js')}}" defer></script>
    <title>Title - @yield('title')</title>
</head>
<body>
<div
    class="d-flex flex-column flex-md-row justify-content-md-between p-3 px-md-4 bg-white border-bottom shadow-sm mb-4">
    <h5 class="my-0 mr-md-auto font-weight-normal">Laravel App</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-3 text-dark" href="{{route('home.index')}}">Home</a>
        <a class="p-3 text-dark" href="{{route('home.contact')}}">Contact</a>
        <a class="p-3 text-dark" href="{{route('posts.index')}}">Blog Posts</a>
        <a class="p-3 text-dark" href="{{route('posts.create')}}">Add New Post</a>
        @guest
            <a class="p-3 text-dark" href="{{route('register')}}">Register</a>
            <a class="p-3 text-dark" href="{{route('login')}}">Login</a>
        @else
            <a class="p-3 text-dark" href="{{route('logout')}}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit()">Log-Out({{\Illuminate\Support\Facades\Auth::user()->name}})</a>
            <form action="{{route('logout')}}" method="POST" id="logout-form" style="display: none">
                @csrf
            </form>
        @endguest
    </nav>
</div>
<div class="container">
    {{--   because flush message save in session here write session    --}}
    @if(session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>

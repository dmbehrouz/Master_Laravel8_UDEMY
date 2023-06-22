<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title - @yield('title')</title>
</head>
<body>
    <div>
        {{--   because flush message save in session here write session    --}}
        @if(session('status'))
            <div style="background-color: #0b2e13;color:white"> {{ session('status') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>

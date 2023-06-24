{{--  old is a helper that use session to hold previous value of input  --}}
<div><input type="text" name="title" value="{{old('title', optional($post ?? null)->title) }}"></input></div>
{{-- $error directive show one valivation request with $message variable --}}
@error('title')
<div>{{$message}}</div>
@enderror
<div><textarea name="content">{{old('content',optional($post ?? null)->content) }}</textarea></div>
{{-- $errors object with ShareErrorsFromSession::class hold all errors in session  --}}
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error  }}</li>
        @endforeach
    </ul>
@endif

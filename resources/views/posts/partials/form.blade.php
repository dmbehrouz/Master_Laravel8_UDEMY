<div class="form-group">
    <label for="title">Title</label>
    {{--  old is a helper that use session to hold previous value of input  --}}
    <input type="text" id="title" class="form-control" name="title"
           value="{{old('title', optional($post ?? null)->title) }}">
</div>
{{-- $error directive show one valivation request with $message variable --}}
@error('title')
<div class="alert alert-danger">
    {{$message}}
</div>
@enderror
<div class="form-group mt-3 mb-3">
    <label for="content">Content</label>
    <textarea name="content" id="content"
              class="form-control">{{old('content',optional($post ?? null)->content) }}</textarea>
</div>
{{-- $errors object with ShareErrorsFromSession::class hold all errors in session  --}}
@if($errors->any())
    <div class="mb-3">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error  }}</li>
            @endforeach
        </ul>
    </div>
@endif

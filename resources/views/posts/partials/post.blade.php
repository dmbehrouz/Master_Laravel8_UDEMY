@if($loop->even)
    <div style="color: #007bff">{{$key}} {{ $variable }} {{$post->title}}</div>
@else
    <div>{{$key}} {{ $variable }}  {{$post->title}}</div>
@endif

<div>
{{--  Need to add method type in form tag and then use @method spoofing   --}}
    <form action="{{ route('posts.destroy', ['post'=>$post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete?">
    </form>
</div>

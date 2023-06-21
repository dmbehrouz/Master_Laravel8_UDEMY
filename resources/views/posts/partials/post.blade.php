@if($loop->even)
    <div style="color: #007bff">{{$key}} {{ $variable }} {{$post['title']}}</div>
@else
    <div>{{$key}} {{ $variable }}  {{$post['title']}}</div>
@endif

@if($checkNewPost)
<span class="badge bg-{{$type ?? 'success'}}">
    {{ $slot }}

</span>
@endif

<h3>
    @if($post->trashed())
        <del>
            <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
               href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a>
            @else
                <a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a>
        </del>
    @endif
</h3>

@php($params['name'] = $post->user->name)
@php($params['date'] = $post->created_at)
<x-updateComment :params="$params"/>

@if($post->comments_count)
    <p>{{$post->comments_count}} Comment</p>
@else
    <p>No comments yet!</p>
@endif
<div class="mb-3">
    @auth()
        @if(!$post->trashed())
            @can('update',$post)
                <a href="{{route('posts.edit',['post'=>$post->id])}}" class="btn btn-primary">Edit</a>
            @endcan
        @endif
    @endauth

    @cannot('delete')
        <p class="text-danger">Sorry You cannot use DELETE button</p>
    @endcannot

    @auth()
        @if(!$post->trashed())
            @can('delete',$post)
                {{--  Need to add method type in form tag and then use @method spoofing   --}}
                <form class="d-inline" action="{{ route('posts.destroy', ['post'=>$post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete?" class="btn btn-danger">
                </form>
            @endcan
        @endif
    @endauth
</div>

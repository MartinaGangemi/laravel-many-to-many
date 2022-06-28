@extends('layouts.admin')

@section('content')

<div class="container">
    <img src="{{$post->img}}" alt="">
    <h1>{{$post->title}}</h1>
    <div class="metadata">
        Category: {{$post->category ?  $post->category-> name : 'nessuna categoria'}}
    </div>
    <p>{{$post->content}}</p>
    <p>
        @if (count($post->tags) > 0)
            <strong>Tag:</strong>
            @foreach ($post->tags as $tag)
            <span>#{{$tag->name}}
                @if(!$loop->last)
                ,
                @endif</span>
            @endforeach
        @else
        <span>Nessun tag</span>
        @endif
    </p>
</div>


@endsection
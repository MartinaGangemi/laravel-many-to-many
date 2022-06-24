@extends('layouts.admin')

@section('content')

<div class="container">
    <img src="{{$post->img}}" alt="">
    <h1>{{$post->title}}</h1>
    <div class="metadata">
        Category: {{$post->category ?  $post->category-> name : 'nessuna categoria'}}
    </div>
    <p>{{$post->content}}</p>
</div>


@endsection
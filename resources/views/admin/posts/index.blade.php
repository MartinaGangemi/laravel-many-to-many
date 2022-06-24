
@extends('layouts.admin')

@section('content')
<div class="container">

    <div>
        <a href="{{route('admin.posts.create')}}" class="btn btn-primary text-light">Create Post</a>
    </div>

    @if (session('message'))
    <div class="alert alert-success mt-2">
        {{ session('message') }}
    </div>
    @endif

    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Img</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td scope="row">{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td><img width="150" src="{{$post->img}}" alt="{{$post->title}}"></td>
                <td>{{$post->category ?  $post->category-> name : 'nessuna categoria'}}</td>
                <td>
                    <a class="btn-crud btn btn-primary text-light" href="{{route('admin.posts.show', $post->slug)}}">View</a>  
                    <a class="btn-crud btn btn-secondary text-light my-2" href="{{route('admin.posts.edit', $post->slug)}}">Edit</a>
                
                    <!-- Button trigger modal -->
                    <button type="button" class="btn-crud btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->slug}}">
                    Elimina
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="delete-post-{{$post->slug}}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{$post->slug}}" aria-hslugden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Elimina {{$post->title}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler cancellare {{$post->title}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{route('admin.posts.destroy', $post->slug)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="btn btn-danger text-light" type="submit"> Elimina</button>

                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td scope="row"> Nessun Post da mostrare!</td>
            </tr>
            @endforelse

        </tbody>
    </table>


</div>
@endsection

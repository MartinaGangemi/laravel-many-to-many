@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>Categorie</h1>

    <div>
        <a href="{{route('admin.categories.create')}}" class="btn btn-primary text-light">Create Categories</a>
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
                <th>Name</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($cats as $cat)
            <tr>
                <td scope="row">{{$cat->id}}</td>
                <td>{{$cat->name}}</td>
                <td>
                    <a class="btn-crud btn btn-secondary text-light my-2" href="{{route('admin.categories.edit', $cat->slug)}}">Edit</a> 
                     <!-- Button trigger modal -->
                     <button type="button" class="btn-crud btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#delete-cat-{{$cat->slug}}">
                    Elimina
                    </button>
                     <!-- Modal -->
                     <div class="modal fade" id="delete-cat-{{$cat->slug}}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{$cat->slug}}" aria-hslugden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Elimina {{$cat->title}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler cancellare {{$cat->title}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{route('admin.categories.destroy', $cat->slug)}}" method="post">
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
                <td scope="row"> Nessuna categoria da mostrare!</td>
            </tr>
            @endforelse

        </tbody>
    </table>

</div>


@endsection
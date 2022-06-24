@extends('layouts.admin')

@section('content')
<div class="container">
    
    

    <div class="card-body text-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h3>Benvenuto  {{ Auth::user()->name }}</h3>
        
        Inizia a scrivere un post <br>
        <div>
            <a href="{{route('admin.posts.create')}}" class="btn btn-primary text-light mt-2">Create Post</a>
        </div>
    </div>
     
</div>
@endsection


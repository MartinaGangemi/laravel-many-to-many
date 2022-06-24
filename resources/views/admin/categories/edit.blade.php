@extends('layouts.admin')

@section('content')
<div class="container">
    <div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
    <form action="{{route('admin.categories.update', $category->slug)}}" method="post">
        @csrf 
        @method ('PUT')
       

    <div class="form-group">
        <label for="name">name</label>
        <input type="text" name="name" id="name"  class="@error('name') is-invalid @enderror form-control"   value ="{{$category->name}}" >
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
   
    
    
    <button type="submit" class="btn btn-danger text-light mt-4">Edit Post</button>
    
    </form>
    
</div>
@endsection
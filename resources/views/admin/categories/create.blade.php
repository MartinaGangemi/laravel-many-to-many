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
    <form action="{{route('admin.categories.store')}}" method="post">
        @csrf 
       

    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" name="name" id="name"  class="@error('name') is-invalid @enderror form-control"  value="{{ old('name') }}" >
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
  
    
    
    <button type="submit" class="btn btn-danger mt-2 text-light">Add Category</button>
    
    </form>
    
</div>
@endsection
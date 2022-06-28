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
    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf 
       
    <!-- titolo -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title"  class="@error('title') is-invalid @enderror form-control"  value="{{ old('title') }}" >
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <!-- contenuto -->
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content"  class="@error('content') is-invalid @enderror form-control"  rows="4"  >
        {{ old('content') }}
        </textarea>
        @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <!-- Img -->
    <div class="form-group">
        <label for="thumb">Image</label>
        <input type="file" name="img" id="img"  class="@error('img') is-invalid @enderror form-control" value="{{ old('img') }}" >
        @error('img')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <!-- Categoria -->
    <div class="form-group">
      <label for="category_id" class="form-label ">Category</label>
      <select class=" @error('category_id') is-invalid @enderror form-control " name="category_id" id="category_id">
        
        <option value = "">Seleziona una categoria</option>
        @foreach($categories as $category)
        <option value="{{ $category->id}}" >{{$category->name}}</option>
        @endforeach
        
      </select>
    </div>
    <!-- Tag -->
    <div class="form-group">
      <label for="tags" class="form-label ">Tags</label>
      <select multiple class=" @error('tags') is-invalid @enderror form-select " name="tags[]" id="tags">
        
        <option value = "">Seleziona una categoria</option>
        @forelse($tags as $tag)
        <option value="{{ $tag->id}}" >{{$tag->name}}</option>
        @empty
        <option value = "">No Tags</option>
        @endforelse
      </select>
      @error('tags')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    
    
    <button type="submit" class="btn btn-danger mt-2 text-light">Add Post</button>
    
    </form>
    
</div>
@endsection

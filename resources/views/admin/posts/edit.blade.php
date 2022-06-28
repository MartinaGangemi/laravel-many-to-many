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
    <form action="{{route('admin.posts.update', $post->slug)}}" method="post" enctype="multipart/form-data">
        @csrf 
        @method ('PUT')
       

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title"  class="@error('title') is-invalid @enderror form-control"   value ="{{$post->title}}" >
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content"  class="form-control"  rows="4">
        {{$post->content}}
        </textarea>
        
    </div>
    <div class="form-group">
        <label for="thumb">Image</label>
        <input type="file" name="img" id="img"  class="@error('img') is-invalid @enderror form-control"  value ="{{asset('storage/' . $post->img)}}" >
        @error('img')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label ">Category</label>
      <select class=" @error('category_id') is-invalid @enderror form-control " name="category_id" id="category_id">
        
        <option value = "">Seleziona una categoria</option>
        @foreach($categories as $category)
        <option value="{{ $category->id}}" {{$category->id == old('category', $post->category_id) ? 'selected' : ''}} >{{$category->name}}</option>
        @endforeach
        
      </select>
    </div>
    <div class="form-group">
      <label for="tags" class="form-label ">Tags</label>
      <select multiple class=" @error('tags') is-invalid @enderror form-select " name="tags[]" id="tags">
        
        <option value = "">Seleziona una categoria</option>
        @forelse ($tags as $tag)

        @if($errors->any())
        (!empty($variables['attributes']['class']) && in_array('glb-table', $variables['attributes']['class'], TRUE))
        <option value="{{$tag->id}}" {{  in_array($tag->id, old('tag', [])) ? 'selected' : ''}} >{{$tag->name}}</option>
        @else
        <option value="{{$tag->id}}" {{  $post->tags->contains($tag) ? 'selected' : ''}} >{{$tag->name}}</option>
        @endif
        
        @empty
        <option value = "">No Tags</option>
        @endforelse
      </select>
      @error('tags')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    
    
    
    <button type="submit" class="btn btn-danger text-light mt-4">Edit Post</button>
    
    </form>
    
</div>
@endsection

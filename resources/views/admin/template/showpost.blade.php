@extends('admin.layouts.admin')

@section('admin-content')

<div id="admin">
  <div class="d-flex" id="wrapper">
      @include('admin.partials._sidenav')
      <form action="{{route('posts.update' , $post->id)}}" method="POST" enctype="multipart/form-data" class="mx-auto border border-light ml-5 p-5 col-md-7" >
          @csrf   
          {{ method_field('PATCH') }}
        <div class="form-group ">
          <label for="slug">Slug </label>
          <input name="slug"  placeholder="Enter Slug for Post" type="text" class="form-control" value="{{$post->slug}}" />
        </div>
        <label class="float-left" for="name">Post  </label>
        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="title" value="{{$post->title}}">

        <label class="float-left" for="name">Post Body</label>
        <input name="description" value=" {{$post->body}} " type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Name">
    
        <label class="float-left" for="name"> Author </label>
        <input type="text" id="defaultContactFormEmail" class="form-control mb-4"  onkeydown="return false"   value="{{$post->user->name}}">

        <label class="float-left" for="name"> Created At </label>
        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" onkeydown="return false" value="{{$post->created_at}}">
        <label class="float-left container" for="name"> Image </label>
        <img class="img-thumbnail" src="/images/{{$post->image}}" alt="">
        <div class="form-group">
          <input type="file"  class="form-control" name="img" >
        </div>
        <label for="message">Category</label>
        <select name="category" class="browser-default custom-select mb-4">
          @foreach ($categories as $category)  
              <option value="{{ $category->id }}"{{ $category->id ==$post->category_id ? ' selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select> 
        <div class="form-group">
          <button type="submit" class="btn btn-primary ">
                 Edit 
          </button>
          <a href="{{url('admin/approve')}}" class="btn btn-danger mx-auto" type="submit">Close</a>
      </div>
    </form>   
  </div>
</div>
@jquery
    @toastr_js
    @toastr_render
    <br><br>
@endsection
@section('scripts')
<script>
  @if(count($errors) > 0)
      @foreach($errors->all() as $error)
          toastr.error("{{ $error }}");
      @endforeach
  @endif
</script>
@endsection
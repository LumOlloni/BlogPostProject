@extends('frontend.layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2 mx-auto mt-4">
          <h1 class="text-center">Edit Post</h1>
      <form action="{{route('posts.update' , $post->id)}}" method="POST" enctype="multipart/form-data">
          @csrf   
          {{ method_field('PATCH') }}
              <div class="form-group ">
                  <label for="slug">@lang('home.slug') </label>
                  <input placeholder="Enter Slug for Post" type="text" class="form-control" value="{{$post->slug}}" name="slug" />
              
              </div>
              <div class="form-group">
                  <label for="title">@lang('home.title') </label>
                  <input placeholder="Enter Title" value="{{$post->title}}" type="text" class="form-control" name="title" />
              </div>
              <div class="form-group">
                  <label for="description">@lang('home.body')</label>
                  <textarea id="editor"  rows="5" class="form-control" name="description" >{!! $post->body !!}</textarea>
              </div>
              <div class="form-group">
                      <label for="message">@lang('home.image')</label>
                      <input type="file"  class="form-control" name="img" >
                  </div>
              <label for="message">@lang('home.category')</label>
              <select name="category" class="browser-default custom-select mb-4">
                  @foreach ($categories as $category)  
                       <option value="{{ $category->id }}"{{ $category->id ==$post->category_id ? ' selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
              </select> 
              
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">
                          @lang('home.create')
                  </button>
              </div>
          </form>
      </div>
  </div>
  @jquery
  @toastr_js
  @toastr_render
</div>
<br><br><br>

@endsection
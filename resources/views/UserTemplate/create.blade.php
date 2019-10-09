@extends('layouts.app')

@section('stylesheet')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mx-auto mt-4">
                <h1 class="text-center">Create post</h1>
            <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf 
                    <div class="form-group ">
                        <label for="slug">Slug </label>
                        <input placeholder="Enter Slug for Post" type="text" class="form-control" name="slug" />
                    
                    </div>
                    <div class="form-group">
                        <label for="title">Title </label>
                        <input placeholder="Enter Title" type="text" class="form-control" name="title" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="editor"  rows="5" class="form-control" name="description" ></textarea>
                    </div>
                    <div class="form-group">
                            <label for="message">Image of Post</label>
                            <input type="file" class="form-control" name="img" >
                        </div>
                    <label for="message">Category of Post</label>
                    <select name="category" class="browser-default custom-select mb-4">
                        @foreach ($category as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select> 
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            Create
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
@section('scripts')
    <script>
            CKEDITOR.replace( 'description' );
    </script>
    <script>
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

@endsection


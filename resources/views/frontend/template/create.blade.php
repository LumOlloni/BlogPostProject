@extends('frontend.layouts.app')

@section('stylesheet')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mx-auto mt-4">
                <h1 class="text-center">@lang('home.create_p')</h1>
            <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf 
                    <div class="form-group ">
                        <label for="slug">@lang('home.slug') </label>
                        <input value=" {{old('slug')}} " placeholder="Enter Slug for Post" type="text" class="form-control" name="slug" />
                    
                    </div>
                    <div class="form-group">
                        <label for="title">@lang('home.title') </label>
                        <input value=" {{old('title')}} " placeholder="Enter Title" type="text" class="form-control" name="title" />
                    </div>
                    <div class="form-group">
                        <label for="description">@lang('home.body')</label>
                        <textarea  id="editor"  rows="5" class="form-control" name="description" > {{old('description')}} </textarea>
                    </div>
                    <div class="form-group">
                            <label for="message">@lang('home.image')</label>
                            <input type="file" class="form-control" name="img" >
                        </div>
                    <label for="message">@lang('home.category')</label>
                    <select name="category" class="browser-default custom-select mb-4">
                        @foreach ($category as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
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


@extends('admin.layouts.admin')

@section('admin-content')

<div id="admin">
  <div class="d-flex" id="wrapper">
      @include('admin.partials._sidenav')
      <form class="mx-auto border border-light ml-5 p-5 col-md-7">

        <label class="float-left" for="name">Post  </label>
        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" value="{{$post->title}}">

        <label class="float-left" for="name">Post Body</label>
        <input value=" {{$post->body}} " type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Name">
    
        <label class="float-left" for="name"> Author </label>
        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" value="{{$post->user->name}}">

        <label class="float-left" for="name"> Created At </label>
        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" value="{{$post->created_at}}">
        <label class="float-left container" for="name"> Image </label>
        <img class="img-thumbnail" src="/images/{{$post->image}}" alt="">
         
         <a href="{{url('admin/approve')}}" class="btn btn-danger mx-auto" type="submit">Close</a>
    </form>   
  </div>
</div>

@endsection
@extends('admin.layouts.admin')

@section('admin-content')

<div id="admin">
    <div class="d-flex" id="wrapper">
        @include('admin.partials._sidenav')
  <form class="mx-auto border border-light ml-5 p-5 col-md-7">

    <label class="float-left" for="name">Name</label>
    <input value=" {{$category->name}} " type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Name">

    <label class="float-left" for="name">Created_at</label>
    <input type="text" id="defaultContactFormEmail" class="form-control mb-4" value="{{$category->created_at}}">
     
     <a href="{{url('admin/category')}}" class="btn btn-danger mx-auto" type="submit">Close</a>
</form>
    </div>
  </div>
</div>


@endsection
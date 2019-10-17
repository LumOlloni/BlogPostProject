@extends('admin.layouts.admin')

@section('admin-content')

<div id="admin">
    <div class="d-flex" id="wrapper">
        @include('admin.partials._sidenav')
<form class="mx-auto border border-light ml-5 p-5 col-md-7">

    <p class="h4 mb-4">User Name {{$user->name}} </p>

    <label class="float-left" for="name">Name</label>
    <input value=" {{$user->name}} " type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Name">

    <label class="float-left" for="name">Email</label>
    <input type="text" id="defaultContactFormEmail" class="form-control mb-4" value="{{$user->email}}">
     <label class="float-left" for="name">Member Since</label>
     <input type="text" id="defaultContactFormEmail" class="form-control mb-4" value="{{$user->created_at}}">
    <a href="#" class="btn btn-danger btn-block " type="submit">Close</a>
</form>
    </div>
  </div>
</div>


@endsection
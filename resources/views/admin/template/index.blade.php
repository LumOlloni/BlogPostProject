@extends('admin.layouts.admin')

@section('admin-content')

<div id="admin">
  <div class="d-flex" id="wrapper">
      @include('admin.partials._sidenav')
      <div id="page-content-wrapper">
        <div class="container-fluid">
        <h1 class="mt-4">Welcome {{Auth::user()->name}}   build something cool </h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla deleniti, hic cumque, cupiditate veniam odit similique libero laborum, inventore nostrum enim in debitis! Itaque quidem perspiciatis tempore consequuntur voluptate, amet illo quibusdam quis sit, doloremque est, mollitia quisquam? Consequuntur, perspiciatis.</p>
        </div>
      </div>
    </div>
  </div>

  @jquery
  @toastr_js
  @toastr_render
@endsection

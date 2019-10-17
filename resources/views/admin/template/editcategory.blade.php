@extends('admin.layouts.admin')

@section('admin-content')

<div id="admin">
    <div class="d-flex" id="wrapper">
        @include('admin.partials._sidenav')
  <form action="{{route('category.update' , $category->id)}}" class="mx-auto border border-light ml-5 p-5 col-md-7" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
      <label class="float-left" for="name">Name</label>
      <input value=" {{$category->name}}" name="category" type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Name">
      <button class="btn btn-primary btn-block" type="submit">Update</button>
  </form>
    </div>
  </div>
</div>
@jquery
  @toastr_js
  @toastr_render
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
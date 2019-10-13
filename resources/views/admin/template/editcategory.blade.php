@extends('admin.layouts.admin')

@section('admin-content')

  <h2 class="text-center ">Edit Category</h2>
  <div class="container mt-4">
      <div class="row justify-content-center">
          <div class="col-md-8">
        <form action="{{route('category.update' , $category->id)}}" method="POST">
        @csrf
       
        <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right" for="">Category Name</label>
          <div class="col-md-6">
          <input type="text" value="{{$category->name}}" placeholder="enter Category" class="form-control" name="category" id="">
          </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                   Submit
                </button>
            </div>
        </div>
        {{ method_field('PUT') }}
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
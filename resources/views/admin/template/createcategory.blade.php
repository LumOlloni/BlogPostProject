@extends('admin.layouts.admin')

@section('admin-content')

    <h2 class="text-center mt-4 ">Add Category</h2>
    <div class="container ">
      <div class="col-md-5 mx-auto">
      <form action="{{route('category.store')}}" method="POST">
          @csrf
        <div class="form-group">
          <label>Category</label>
          <input value="{{old('category')}}" name="category" type="text" class="form-control" placeholder="Enter category">
        </div>
        <button type="submit" class="btn btn-block btn-primary">Submit</button>
      </form>
    </div>
    @jquery
    @toastr_js
    @toastr_render
    </div>
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
@extends('admin.layouts.admin')

@section('admin-content')

  <h2 class="text-center mt-4 text-primary">Approve Post</h2>
  <div class="container">
    @if (count($post) > 0)
        
  <table class="table">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Body</th>
          <th scope="col">Accept</th>
          <th scope="col">Reject</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($post as $item)
          <tr>
            <td>{{$item->title}}</td>
            <td>{!! $item->body !!}</td>
              <td><button type="button" data-id="{{$item->id}}" value="1" class="btn btnRequest btn-success">Accept</button></td>
              <td><button type="button" data-id="{{$item->id}}" value="2" class="btnRequest btn btn-danger">Reject</button></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @else
      <h2 class="text-danger text-center mt-4">No Post to approve!!</h2>
    @endif
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
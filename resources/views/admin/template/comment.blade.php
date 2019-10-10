@extends('admin.layouts.admin')

@section('admin-content')

  <div class="contaner">
      <h2 class="text-center mt-4 text-primary">Approve Comments</h2>
      <div class="container">
        @if (count($comment) > 0)
            
      <table class="table">
          <thead>
            <tr>
              <th scope="col">User</th>
              <th scope="col">Post</th>
              <th scope="col">Body Comment</th>
              <th scope="col">Accept</th>
              <th scope="col">Reject</th>
            </tr>
          </thead>
          <tbody>
       
            @foreach ($comment as $item)
                <tr>
                  <td> {{$item->user->name}} </td>
                  <td> {{$item->post->title}}  </td>
                  <td> {{$item->body}} </td>
                  <form action="{{url('/admin/approveComments' , $item->id)}}" method="POST">
                    @csrf
                    <td><button name="updatecomment" value="1" type="submit" class="btn  btn-success">Accept</button></td>
                    <td><button type="submit" name="updatecomment" value="2"  class="btn btn-danger">Reject</button></td>
                  </form>
              </tr>
              @endforeach
          </tbody>
        </table>
        @else
          <h2 class="text-danger text-center mt-4">No Comment to approve!!</h2>
        @endif
      </div>
  </div>
@jquery
@toastr_js
@toastr_render
@endsection
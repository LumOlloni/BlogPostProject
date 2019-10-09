@extends('layouts.admin')

@section('admin-content')
  <h2 class="text-center text-primary mt-4">Category</h2>
  <div class="container">
    <table class="table">
        <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category as $item)
              <tr>
                <td>{{$item->name}}</td>
                <td><a href="{{route('category.edit' , $item->id)}} " class="btn btn-warning">Edit</a></td>
                <form action=" {{route('category.destroy' , $item->id)}}" method="POST">
                  @csrf
                  <td><button class="btn btn-danger">Delete</button></td>
                  {{ method_field('DELETE') }}
                </form>
              </tr>
              @endforeach
          </tbody>
    </table>
  </div>
@endsection
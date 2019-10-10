@extends('frontend.layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6 col-md-offset-2 text-center ">
        <div class="card" style="margin-left: 180px;">
          <h1 class="card-title">{{$post->title}}</h1>
          <div class="card-body">
            <img src="/images/{{$post->image}}" alt="">
            <p class="card-text">{!! $post->body !!}</p>
            <p class="card-text">Created: {{$post->created_at}}</p>
            <p class="card-text">Category: {{$post->category->name}}</p>
            <small>Written By {{$post->user->name}} </small>
          </div>
          @mypost(Auth::user(),$post)
          <div class="d-flex justify-content-center">
              <div class="p-4 w-50">
                <button type="button" class="btn btn-warning w-50">
                  Edit
                </button>
            </div>
            <div class="p-4 w-50">
                <button type="button" class="btn btn-danger w-50">
                  Delete
                </button>
              </div>
          </div>
          @endmypost
        </div>
      </div> 
      <div class="col-md-4 col-md-offset-2">
        <form action="{{route('comments.store')}}" method="POST">
          @csrf
          <div class="form-group">
              <label for="usr">Comment:</label>
              <input type="text" name="comment" class="form-control">
            </div>
            <input type="hidden" name="post_id" value=" {{$post->id}} ">
            <div class="form-group">
              <button type="submit" name="button" class="btn btn-success btn-block">Create Comment</button>
            </div>
          </form>
      </div>
    </div>
  </div>
<br><br>
@endsection
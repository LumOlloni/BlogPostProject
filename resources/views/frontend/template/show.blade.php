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
                <a href=" {{route('posts.edit' , $post->id)}} " type="submit" class="btn btn-warning w-50">
                  Edit
                </a>
            </div>
            <form action=" {{route('posts.destroy' , $post->id)}} " method="POST">
              @csrf
              <div class="p-4 w-50">
                  <button type="submit" class="btn btn-danger ">
                    Delete
                  </button>
                </div>
            </div>
            {{ method_field('DELETE') }}
          </form>
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
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="form-group">
              <button type="submit" name="button" class="btn btn-success btn-block">Create Comment</button>
            </div>
          </form>
          @foreach ($comment as $item)
            @if ($item->post_id == $post->id)
              <div class="card">
                <div class="card-body"> Body: {{$item->body}} </div>
                <small class="card-text">Written by:{{$item->user->name}} </small>
                @myComment(Auth::user() , $item)
                  <form action="{{route('comments.destroy' , $item->id)}}" method="POST">
                    @csrf
                    <p class="card-text text-center"><button type="submit" class="btn btn-danger"> Delete Comment</button></p> 
                    {{ method_field('DELETE') }}
                  </form>
                @endmyComment
              </div>
            @endif
          @endforeach
      </div>
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
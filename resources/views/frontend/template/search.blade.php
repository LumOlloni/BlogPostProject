@extends('frontend.layouts.app')

@section('content')

  <div class="container mt-4">
    <div class="row">
      @if (count($post) > 0)
      @foreach ($post as $item)
      <div class="col-md-6 col-md-offset-2 text-center">
        <h1 class="card-title">{{$item->title}}</h1>
        <div class="card-body">
          <img src="/images/{{$item->image}}" alt="">
          <p class="card-text">{!! $item->body !!}</p>
          <p class="card-text"> Created at {{$item->created_at}} </p>
          <p class="card-text">Category: {{$item->category->name}}   </p>
          <small>Written By {{$item->user->name}} </small>
        </div>
      </div>
      @endforeach
      @else 
      <h2 class="text-center text-danger">No Posts Found</h2>
      @endif
    </div>
  </div>


@endsection
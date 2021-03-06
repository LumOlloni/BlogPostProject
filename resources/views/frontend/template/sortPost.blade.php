@extends('frontend.layouts.app')

@section('content')

<div class="container mt-4">
  <div class="row no-gutters">
    @if (isset($postDate))
            @foreach ($postDate as $p)
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="/thumbnail/{{$p->image}}" alt="">
                            <h5  class="text-muted">{{$p->title}}</h5>
                            <p class="card-text"> {!! $p->text($p->body,20) !!} </p>
                            <div class="d-flex justify-content-left">
                                <div class="p-1">
                                    <a href="/home/{{$p->slug}}" class="btn btn-info styleButton">@lang('home.read') </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @else 
             
            @foreach ($postAdmin as $p)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <img src="/thumbnail/{{$p->image}}" alt="">
                        <h5  class="text-muted">{{$p->title}}</h5>
                        <p class="card-text"> {!! $p->text($p->body,20) !!} </p>
                        <div class="d-flex justify-content-left">
                            <div class="p-1">
                                <a href="/home/{{$p->slug}}" class="btn btn-info styleButton">@lang('home.read') </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
        @endif
    </div>
</div>
<br><br>
@endsection
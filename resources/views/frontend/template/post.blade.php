@extends('frontend.layouts.app')

@section('content')
    <h2 class="text-center mt-4">@lang('home.post_user')</h2>
    <section class="search-sec">
        <div class="container">
           <form action="{{route('search')}}" method="POST" >
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">   
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <input name="search" type="text" class="form-control search-slt" placeholder="Enter Post">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <select name="category" class="form-control search-slt" id="exampleFormControlSelect1">
                                    @foreach ($cat as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach         
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <button type="submit"   class="btn btn-success wrn-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <div class="container mt-4">
        <div class="row no-gutters">
            @if (count($post) > 0)
                @foreach ($post as $p)
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
        {{ $post->links() }}
    </div>
    
    @jquery
    @toastr_js
    @toastr_render
    <br><br>
@endsection
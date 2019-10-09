@extends('layouts.app')

@section('content')
    <h2 class="text-center mt-4">All Post of Users</h2>
    <div class="container mt-4">
        <div class="row no-gutters">
            @if (count($post) > 0)
                @foreach ($post as $p)
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="/thumbnail/{{$p->image}}" alt="">
                                <h5  class="text-muted">{{$p->title}}</h5>
                                <p class="card-text"> {!! $p->limit_text($p->body,20) !!} </p>
                                <div class="d-flex justify-content-left">
                                    <div class="p-1">
                                        <a href="/home/{{$p->slug}}" class="btn btn-info styleButton">Shiko Detajet </a>
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
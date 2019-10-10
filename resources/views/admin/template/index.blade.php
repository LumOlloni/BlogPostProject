@extends('admin.layouts.admin')

@section('admin-content')



<div class="jumbotron card card-image " id="jumboStyle" >
    <div class="text-white text-center py-5 px-4">
      <div>
        <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Welcome {{Auth::user()->name}} to  Admin Dashboard </strong></h2>
        <p class="mx-5 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
          optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos. Odit sed qui, dolorum!
        </p>
       
      </div>
    </div>
  </div>
    
@endsection
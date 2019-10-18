@extends('admin.layouts.admin')
@section('style')
  
    {{-- <title>Laravel DataTable Ajax Crud Tutorial - Tuts Make</title> --}}
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
@endsection

@section('admin-content')

<div id="admin">
    <div class="d-flex" id="wrapper">
        @include('admin.partials._sidenav')
        <div class="container mt-4">
            <table class="table table-bordered table-striped" id="laravel_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Post Title</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')

    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script>
        var SITEURL = '{{URL::to('')}}';
       
        $(document).ready( function () {
            
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                url: "{{route('comments.index')}}",
                type: 'GET',
        },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  { data: 'name', name: 'users.name' },
                  { data: 'title', name: 'posts.title' },
                  { data: 'body', name: 'comments.body' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });

      $('body').on('click' , '.button' , function () {
        var comment_id = $(this).data("id");
        var button = this;
        $.ajax({
          url:SITEURL + '/admin/approveComments/'+comment_id,
          type: 'POST', 
          data:{
            btn:$(this).attr("value")
          },
          success:function(response){
            console.log(response);
            var oTable = $('#laravel_datatable').dataTable(); 
            oTable.fnDraw(false);
          },
          error: function (data) {
            console.log('Error:', data);
          }
          
        });
      });


    $('body').on('click' , '#show-comment' , function () {
        
        var comment_id = $(this).data("id");
        $.ajax ({
        type:'GET',
        'url':SITEURL + '/admin/comment/'  + comment_id +'/show',
        success:function (response){
            window.location.href = "http://localhost:8000/admin/comment/" + comment_id + '/show'
        },
        error: function (data) {
            console.log('Error:', data);
        }
    })  
 }) 
});
    </script>
@endsection
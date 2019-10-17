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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                        DELETE CONFIRMATION
                </div>
                <form action=""  id="deleteForm" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p class="text-center">Are You Sure Want To Delete ?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <a  data-dismiss="modal" class="btn btn-danger  btn-ok">Delete</a>
                </div>
                </form>
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
                url: SITEURL + "/admin/users",
                type: 'GET',
        },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'created_at', name: 'created_at' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });

      $('body').on('click' , '#delete-user' , function () {
        var user_id = $(this).data("id");
            localStorage.setItem('idDElete', user_id);
          $('#confirm-delete').modal('show');
      })

 
    $('body').on('click', '#deleteForm', function () {
        var user_id = localStorage.getItem('idDElete');         
        $.ajax({
            type: "delete",
            dataType:"json",

            url: SITEURL + "/admin/users/delete/"+user_id,
            success: function (data) {
            var oTable = $('#laravel_datatable').dataTable(); 
            oTable.fnDraw(false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }); 
    $('body').on('click' , '#show-user' , function () {
        var user_id = $(this).data("id");
        $.ajax ({
        type:'GET',
        'url':SITEURL + '/admin/users/'  + user_id +'/show',
        success:function (response){
            window.location.href = "http://localhost:8000/admin/users/" + user_id + '/show'
        },
        error: function (data) {
            console.log('Error:', data);
        }
    })  
 })
   
    
   });
 
if ($("#userForm").length > 0) {
      $("#userForm").validate({
 
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      
      $.ajax({
          data: $('#userForm').serialize(),
          url: SITEURL + "/admin/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
 
              $('#userForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}       
    </script>
@endsection
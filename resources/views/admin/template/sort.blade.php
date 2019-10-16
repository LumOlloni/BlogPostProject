@extends('admin.layouts.admin')

@section('admin-content')

    <p>&nbsp;</p>
    <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
          <table id="table" class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th>Position</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
              @foreach($post as $p)
                <tr class="row1" data-id="{{ $p->id }}">
                  <td>
                    <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                    </div>
                  </td>
                  
                  <td>{{ $p->title }}</td>
                  <td> {{$p->body}} </td>
                  <td>{{ date('d-m-Y h:m:s',strtotime($p->created_at)) }}</td>
                  <td> {{$p->order}} </td>
                </tr>
              @endforeach
            </tbody>                  
          </table>
      </div>
  </div> 
</div>
  
  @jquery
  @toastr_js
  @toastr_render
@endsection
@section('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

  <script type="text/javascript">

     $(function () {
      
      $( "#tablecontents" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
          
        }

       
      });

      function sendOrderToServer() {

        var order = [];
        $('tr.row1').each(function(index,element) {
          order.push({
            id: $(this).attr('data-id'),
            position: index+1
          });
        });

        $.ajax({
          type: "POST", 
          dataType: "json", 
          url: " {{ url('admin/updatePost')}} ",
          data: {
            order:order,
            _token: '{{csrf_token()}}'
          },
          success: function(response) {
              if (response.status == 'success') {
                console.log(response);
                window.location.href = "http://localhost:8000/admin/sort"
              } else {
                console.log(response);
              }
          }
        });
       
     
    }
  });
  </script>
@endsection
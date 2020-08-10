<!DOCTYPE html>
<html>
<title>Ajax Tutorial</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">


<body>
    
  <table class="table table-bordered" id="user_table">
    <thead>
      <tr>
        <th scope="col">Image</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
  </table>

    <form method="POST" id="sample_form" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="file" id="image" name="image">
        </div>
        <div class="form-group">
            <input type="hidden" name="hidden_id" id="hidden_id">
        </div>
        <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Add">
      </form>
      <span id="form_result"></span>

</body>
<script>
    $(document).ready(function(){

        $('#user_table').DataTable({
          processing: true,
          serverSide:true,
          ajax:{
            url: "{{ route('ajax.index') }}",
          },
          columns:[
            {
              data:'image',
              name:'image',
              render: function(data,type,full,meta){
                return "<img src={{URL::to('/')}}/images/" + data + "width='70' class='img-thumbnail'>"
              },
              orderable: false,
            }
            {
                data: 'first_name',
                name: 'first_name',
            },
            {
              data: 'last_name',
              name: 'last_name',
            },
            {
              data: 'action',
              name: 'action',
              orderable: false,
            }
          ]
        });

        $('#sample_form').on('submit', function(event){
              event.preventDefault;
              if($('#action').val() == 'Add'){
                $ajax({
                  url: "{{route('ajax.store')}}",
                  method: "POST",
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  dataType: "json",
                  success:function(data){
                    var html = '';
                    if(data.errors){
                      html = '<div class="alert alert-danger">';
                      for(var count=0; count<data.errors.length; count++){
                        html += '<p>' + data.errors[count] + '</p>';
                      }
                      html += '</div>';
                    }
                    if(data.success){
                      html = '<div class="alert alert-success">' + data.success + '</div>';
                      $('#sample_form')[0].reset();
                      $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                  }
                })
              }
        })

    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

</html>

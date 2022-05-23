<!DOCTYPE html>
<html>
<head>
    <title>parents list</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
  <!-- bootstrap edit parent Modal start -->
<div class="modal fade" id="childdetailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Child details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <form id="childdetailform">
              @csrf
              <div class="form-group">
                <label for="first_child">first child</label>
                <input type="text" name="first_child"  class="form-control" id = "first_child" value="" />
              </div>
              <!-- <input type="hidden" name="url">
                <input type="hidden" name="parent_id"> -->
              <div class="form-group">
                <label for="second_child">second child</label>
                <input type="text" name="second_child"  class="form-control" id = "second_child" value="" />
              </div>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary">Add</button> -->
      </div>
    </div>
  </div>
</div>
<!-- bootstrap edit parent modal end -->
<div class="container mt-5">
    <h2 class="mb-4">Parents child List</h2>

    <table class="table table-bordered family-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Father_Name</th>
                <th>Mother_Name</th>
                <th>Mobile_Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
  $(function () {
    
    var table = $('.family-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('family.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'father_name', name: 'father_name'},
            {data: 'mother_name', name: 'mother_name'},
            {data: 'mobile_number', name: 'mobile_number'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

        // start code for take old value in form text value
        $(document).on("click",".childdetail",function(e) {
        e.preventDefault();
        $("#childdetailmodal input[name=url]").val($(this).attr("href"));
        $("#childdetailmodal input[name=parent_id]").val($(this).attr("data-id"));
        var url = $(this).attr("data-url");

        $.ajax({
            type:"GET",
            url:url,                
            success:function(data){
                $("#childdetailmodal input[name=first_child]").val(data.parents.child[0].name);
                $("#childdetailmodal input[name=second_child]").val(data.parents.child[1].name);
                // $("#childdetailmodal input[name=third_child]").val(data.parents.child[2].name);
            },
            error: function(data) {
                alert('error');     
            }
        });
    });
    // end code for take old value in form text value
  });
</script>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>child list</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<!-- bootstrap edit child Modal start -->
<div class="modal fade" id="editchildmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Child Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <form id="editchildform">
              @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value ="" placeholder="Enter name here"/> 
                    <span style = "color : red;">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="father">Father Name</label>
                    <input type="text" name="father_name" class="form-control" value ="" placeholder="Enter father name here" />
                    <span style = "color : red;">@error('father_name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="mother">Mother Name</label>
                    <input type="text" name="mother_name" class="form-control" value ="" placeholder="Enter mother name here" />
                    <span style = "color : red;">@error('mother_name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="birthdate">Date Of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value ="" />
                    <span style = "color : red;">@error('date_of_birth'){{$message}}@enderror</span>
                </div>
                <input type="hidden" name="url">
                <input type="hidden" name="child_id">
                <button type="button" class="btn btn-success" id="editchildbtn" data-dismiss="modal">Add</button>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary">Add</button> -->
      </div>
    </div>
  </div>
</div>
<!-- bootstrap edit child modal end -->

<!-- bootstrap add child Modal start -->
<div class="modal fade" id="addchildmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Child Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <form id="addchildform">
              @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value ="" placeholder="Enter name here"/> 
                    <span style = "color : red;">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="father">Father Name</label>
                    <select class="form-control" name="father_name" id="father_name" data-parsley-required="true">
                        @foreach ($fathers as $key=>$value) 
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <span style = "color : red;">@error('father_name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="mother">Mother Name</label>
                    <input type="text" name="mother_name" id="mother_name" class="form-control" value ="" placeholder="Enter mother name here" />
                    <span style = "color : red;">@error('mother_name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="birthdate">Date Of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value ="" />
                    <span style = "color : red;">@error('date_of_birth'){{$message}}@enderror</span>
                </div>
                <button type="button" class="btn btn-success" id="addchildbtn" data-dismiss="modal">Add</button>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary">Add</button> -->
      </div>
    </div>
  </div>
</div>
<!-- bootstrap add child modal end -->
    
<div class="container mt-5">
    <h2 class="mb-4">Childrens List</h2>
    <!-- add child button start -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addchildmodal">
        Add Child
    </button>
    <!-- add child button end -->
    <table class="table table-bordered child-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Father_Name</th>
                <th>Mother_Name</th>
                <th>Date_Of_Birth</th>
                <th>Age</th>
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
    
    var table = $('.child-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('childrens.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'father_name', name: 'father_name'},
            {data: 'mother_name', name: 'mother_name'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'age', name: 'age'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

    // start code for take old value in form text value
    $(document).on("click",".editbtn",function(e) {
        e.preventDefault();
        $("#editchildmodal input[name=url]").val($(this).attr("href"));
        $("#editchildmodal input[name=child_id]").val($(this).attr("data-id"));
        var url = $(this).attr("data-url");

        $.ajax({
            type:"GET",
            url:url,                
            success:function(data){
                $("#editchildmodal input[name=name]").val(data.childs.name);
                // $("#editchildmodal input[name=father_name]").val(data.childs.parent_id);
                $("#editchildmodal input[name=father_name]").val(data.childs.parents.father_name);
                // $("#editchildmodal input[name=mother_name]").val(data.childs.parent_id.mother_name);
                $("#editchildmodal input[name=mother_name]").val(data.childs.parents.mother_name);
                $("#editchildmodal input[name=date_of_birth]").val(data.childs.date_of_birth);
            },
            error: function(data) {
                alert('error');     
            }
        });
    });
    // end code for take old value in form text value

    // start code for edit child record button
    $(document).on("click","#editchildbtn",function(e) {
        var url = $("input[name=url]").val();
        var child_id = $("input[name=child_id]").val();
        var name = $("input[name=name]").val();
        var father_name = $("input[name=father_name]").val();
        var mother_name = $("input[name=mother_name]").val();
        var date_of_birth = $("input[name=date_of_birth]").val();
        $.ajax({
            type: "POST",
            url : url,
            dataType: 'json' ,
            data:{
                child_id:child_id,
                name:name,
                father_name:father_name , 
                mother_name:mother_name,
                date_of_birth:date_of_birth,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                table.draw();
                $("#editchildform").trigger("reset");
            },
            error: function(data) {
                alert('error');
            }
        });
    });
  // end code for edit child record button

    // start code for delete button
    $(document).on("click",".btn-danger",function(e) {
        e.preventDefault();

        var form =  $(this).closest("btn-danger");
        var href = $(this).val();
            
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            url = $(this).attr('href');
                        
            //put ajax call
            $.ajax({
                type: "get",
                url:url,
                success: function(result) {
                table.draw();
                },
                error: function(result) {
                    alert('error');
                }
            });
        }
    })
  });       
  // end code for delete button

    // code for get mother name 
    $('#father_name').change(function() {
       let id = $(this).val();
       let url = '{{ route("get.mothername",":id") }}';
       url = url.replace(':id', id);
        $.ajax({
            url:url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
               if (response != null) {
                   $('#mother_name').val(response.mother_name);
               }
           }
       })
    });
    // code for get mother name

    // start code for add child record button
    $(document).on("click","#addchildbtn",function(e) {
        var url = '{{ route("add.child") }}';
        var name = $("#addchildform input[name=name]").val();
        var parent_id = $("#addchildform select[name=father_name]").val();
        // alert(parent_id);
        var date_of_birth = $("#addchildform input[name=date_of_birth]").val();
        $.ajax({
            type: "POST",
            url : url,
            dataType: 'json' ,
            data:{
                name:name,
                parent_id:parent_id, 
                date_of_birth:date_of_birth,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                table.draw();
                $("#addchildform").trigger("reset");
            },
            error: function(data) {
                alert('error');
            }
        });
    });
    // end code for add child record button
    
  });
</script>
</html>
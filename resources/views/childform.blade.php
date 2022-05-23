<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>child form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <section style="padding-top:60px">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header"> 
                            Children Information
                        </div>
                        <div class="card-body">

                            @if(Session::has('child_created'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('child_created')}}
                                </div>
                            @endif

                            <form method="POST" action="{{route('child.create')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value ="" placeholder="Enter name here"/> 
                                    <span style = "color : red;">@error('name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="father">Father Name</label>
                                    <!-- <input type="text" name="father_name" class="form-control" value ="" placeholder="Enter father name here" /> -->
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
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
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
</script>
</body>
</html>
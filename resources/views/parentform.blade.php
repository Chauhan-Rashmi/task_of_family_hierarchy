<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>parent form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<section style="padding-top:60px">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header"> 
                            Parent Information
                        </div>
                        <div class="card-body">

                            @if(Session::has('parent_created'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('parent_created')}}
                                </div>
                            @endif
                       
                            <form method="POST" action="{{route('parent.create')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="father">Father Name</label>
                                    <input type="text" name="father_name" class="form-control" value ="" placeholder="Enter father name here"/> 
                                    <span style = "color : red;">@error('father_name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="mother">Mother Name</label>
                                    <input type="text" name="mother_name" class="form-control" value ="" placeholder="Enter mother name here" />
                                    <span style = "color : red;">@error('mother_name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" name="mobile_number" class="form-control" value ="" placeholder="Enter mobile number here" />
                                    <span style = "color : red;">@error('mobile_number'){{$message}}@enderror</span>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
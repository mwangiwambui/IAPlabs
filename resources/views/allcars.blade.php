<!DOCTYPE html>
<html>
<head>
<title>
        All cars
</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">



</head>
<body>
<div class="container">
<div class="row">
    <form action="/cars" method="post" enctype="multipart/form-data">
        @if(count($errors))
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        @endif
        {{ csrf_field() }}
        <div class="form">
            <div class="form-group">
                <label for="make">Make</label>
                <input type="text" class="form-control" id="make" name="make" value="{{old('make')}}" placeholder="Enter make">
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="{{old('model')}}" placeholder="Enter Model">
            </div>
            <div class="form-group">
                <label for="date">Date Manufactured</label>
                <input type="date" class="form-control" id="date" name="date" value="{{old('date')}}" placeholder="Enter date">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>
    <hr>
<div class="row">
    <table class="table table-dark" id="example" >
        <thead>
        <tr>
            <th scope="col">Car Id</th>
            <th scope="col">Make</th>
            <th scope="col">Model</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td>{{$car->id}}</td>
                <td>{{$car->make}}</td>
                <td>{{$car->model}}</td>
                <td><a href="{{route('getreview',$car->id)}}">Add a review </a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>





    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
</body>
</html>

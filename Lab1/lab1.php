<?php
    include_once 'user.php';
    include_once 'fileUploader.php';
    $first_name = '';
    $last_name = '';
    $city = '';
    $username = '';
    $password = '';
    $file = '';
    $utc_timestamp = '';
    $offset = '';



    $user = new User($first_name,$last_name,$city,$username,$password,$file,$utc_timestamp,$offset);
    

    if (isset($_POST['btn-save'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $file = $_FILES['filepath'];
        $utc_timestamp = $_POST['utc_timestamp'];
        $offset = $_POST['time_zone_offset'];

        $user = new User($first_name,$last_name,$city,$username,$password,$file,$utc_timestamp,$offset);
        $uploader = new fileUploader;

        if (!$user->validateForm()) {
            $user->createFormErrorSessions();
            header("Refresh:0");
            die();
        }
        $res = $user->save();
        $file_upload_response = $uploader->uploadFile();
        if ($res) {
            $message = "Save Operation Was successful";
        }else{
            $message = "Save Operation Was Not successful";
        }


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab01</title>


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="validate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="validate.css">
    <script type="text/javascript" src="timezone.js"></script>

    <!-- Custom styles for this template -->
    <link href="floating-labels.css" rel="stylesheet">
</head>
<body>
<div class="container">
     <div class="row">
    <form class="form-signin" method="post" style="margin-left:100px;margin-right:200px;" onsubmit="return validateForm()" name="user_details" id="user_details" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <div class="text-center">   
        <?php
            session_start();
        if (isset($message)) {
            echo
                '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    '.$message.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
        }
       if (!empty($_SESSION['form_errors'])) {
                echo
                '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    '.$_SESSION['form_errors'].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                   </button>
                </div>
                ';
            }
        ?>

            <!-- <svg style="margin-top:-40px;" width="310" height="320"><defs id="SvgjsDefs1023"></defs><g id="SvgjsG1024" featurekey="root" fill="#000000"></g><g id="SvgjsG1025" featurekey="container1" fill="#000000" transform="matrix(1.4961996856738697,0,0,1.4961996856738697,0,5)"><defs xmlns="http://www.w3.org/2000/svg"></defs><path xmlns="http://www.w3.org/2000/svg" d="M100.254,0C44.974,0,0,44.974,0,100.254s44.974,100.254,100.254,100.254c55.28,0,100.254-44.974,100.254-100.254  S155.534,0,100.254,0z M100.254,195.508C47.731,195.508,5,152.777,5,100.254S47.731,5,100.254,5  c52.523,0,95.254,42.73,95.254,95.254S152.777,195.508,100.254,195.508z"></path></g><g id="SvgjsG1026" featurekey="text1" fill="#000000" transform="matrix(3.65265077172301,0,0,3.65265077172301,49.999996815918834,92.47349576620913)"><path d="M0.08 10 l1.32 0 c0.06 0 0.08 0.04 0.08 0.08 l0 12.44 l9.76 0 c0.06 0 0.08 0.04 0.08 0.08 l0 1.32 c0 0.06 -0.02 0.08 -0.08 0.08 l-11.16 0 c-0.06 0 -0.08 -0.02 -0.08 -0.08 l0 -13.84 c0 -0.06 0.04 -0.08 0.08 -0.08 z M17.28 14 l0.24 0 c1.32 0 2.52 0.5 3.62 1.52 l0 -1.46 c0 -0.04 0.04 -0.06 0.08 -0.06 l1.28 0 c0.04 0 0.06 0.02 0.06 0.06 l0 9.88 c0 0.04 -0.02 0.06 -0.06 0.06 l-1.28 0 c-0.04 0 -0.08 -0.02 -0.08 -0.06 l0 -1.46 c-1.1 1.02 -2.22 1.52 -3.4 1.52 l-0.7 0 c-1.26 0 -2.48 -0.6 -3.66 -1.84 c-0.74 -0.98 -1.1 -2 -1.1 -3.06 l0 -0.28 c0 -1.68 0.86 -3.08 2.62 -4.22 c0.82 -0.4 1.62 -0.6 2.38 -0.6 z M13.700000000000001 18.86 l0 0.32 c0 1.2 0.6 2.2 1.8 3.04 c0.64 0.34 1.22 0.5 1.74 0.5 l0.36 0 c1.1 0 2.06 -0.56 2.9 -1.64 c0.42 -0.64 0.64 -1.34 0.64 -2.14 c0 -1.42 -0.74 -2.52 -2.2 -3.34 c-0.54 -0.2 -1.04 -0.32 -1.52 -0.32 c-1.62 0 -2.8 0.84 -3.54 2.52 c-0.12 0.42 -0.18 0.78 -0.18 1.06 z M23.580000000000002 10.66 l1.28 0 c0.06 0 0.08 0.02 0.08 0.06 l0 4.82 c1.06 -1.02 2.3 -1.54 3.7 -1.54 c1.94 0 3.44 0.9 4.52 2.66 c0.4 0.7 0.6 1.5 0.6 2.4 c0 1.76 -0.84 3.16 -2.52 4.24 c-0.78 0.46 -1.66 0.7 -2.64 0.7 c-1.36 0 -2.58 -0.52 -3.66 -1.52 l0 1.46 c0 0.04 -0.02 0.06 -0.08 0.06 l-1.28 0 c-0.04 0 -0.06 -0.02 -0.06 -0.06 l0 -13.22 c0 -0.04 0.02 -0.06 0.06 -0.06 z M24.940000000000005 18.84 l0 0.32 c0 1.34 0.72 2.42 2.18 3.24 c0.62 0.22 1.12 0.34 1.48 0.34 c1.48 0 2.6 -0.72 3.38 -2.16 c0.24 -0.5 0.36 -1.02 0.36 -1.56 l0 -0.02 c0 -1.54 -0.78 -2.7 -2.36 -3.46 c-0.54 -0.16 -1 -0.26 -1.38 -0.26 c-1.42 0 -2.54 0.72 -3.36 2.16 c-0.2 0.56 -0.3 1.02 -0.3 1.4 z M41.720000000000006 10 l0.36 0 c2.22 0 4.1 0.98 5.66 2.92 c0.88 1.26 1.34 2.54 1.34 3.84 l0 0.48 c0 2.02 -0.94 3.8 -2.8 5.32 c-1.32 0.96 -2.74 1.44 -4.24 1.44 l-0.28 0 c-2.5 0 -4.54 -1.18 -6.14 -3.54 c-0.6 -1.16 -0.9 -2.24 -0.9 -3.26 l0 -0.4 c0 -2.24 1.08 -4.14 3.24 -5.68 c1.24 -0.76 2.48 -1.12 3.76 -1.12 z M41.800000000000004 22.52 l0.2 0 c2.04 0 3.66 -1.02 4.86 -3.04 c0.4 -0.84 0.58 -1.68 0.58 -2.52 c0 -2.14 -1.06 -3.8 -3.22 -5.02 c-0.82 -0.32 -1.52 -0.46 -2.1 -0.46 l-0.44 0 c-1.76 0 -3.24 0.86 -4.5 2.6 c-0.54 0.98 -0.82 1.96 -0.82 2.92 c0 1.94 0.88 3.5 2.64 4.7 c0.9 0.54 1.82 0.82 2.8 0.82 z M43.480000000000004 16.92 l0 0.16 c0 0.7 -0.44 1.18 -1.26 1.44 l-0.34 0.04 c-0.76 0 -1.28 -0.42 -1.56 -1.28 l0 -0.36 c0 -0.7 0.42 -1.18 1.24 -1.44 l0.4 -0.04 c1 0.18 1.52 0.68 1.52 1.48 z M54.7 10.08 l0 13.84 c0 0.06 -0.02 0.08 -0.08 0.08 l-1.26 0 c-0.06 0 -0.08 -0.02 -0.08 -0.08 l0 -11.7 l-1.5 2.06 l-1.66 0 c-0.06 0 -0.08 -0.02 -0.08 -0.08 c0.08 -0.04 1 -1.4 2.8 -4.08 l0.12 -0.12 l1.66 0 c0.06 0 0.08 0.04 0.08 0.08 z"></path></g></svg> -->
        </div>

        <div class="form-label-group">
            <input name="first_name" type="text" id="inputEmail" class="form-control" placeholder="First Name" required autofocus>
            <label for="inputEmail">First Name</label>
        </div>

        <div class="form-label-group">
            <input name="last_name" type="text" id="inputPassword" class="form-control" placeholder="Last Name" required>
            <label for="inputPassword">Last Name</label>
        </div>

        <div class="form-label-group">
            <input name="city_name" type="text" id="inputPassword" class="form-control" placeholder="City Name" required>
            <label for="inputPassword">City Name</label>
        </div>
        <div class="form-label-group">
            <input name="username" type="text" id="inputusername" class="form-control" placeholder="Username" required autofocus>
            <label for="inputusername">Username</label>
        </div>
        <div class="form-label-group">
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPassword">Password</label>
        </div>
        <div class="form-label-group">
            <input name="filepath" type="file" id="filepath" placeholder="Profile image" required>
            <label for="filepath">File Upload</label>
        </div>
        <div class="form-label-group">
            <input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
        </div>
        <div class="form-label-group">
            <input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""/>
        </div>


        <button name="btn-save" class="btn btn-lg btn-primary btn-block" type="submit">SAVE</button>
        <!--- Create hidden controls to store client utc date and time zone -->

        <button name="btn-login" class="btn btn-lg btn-primary btn-block" type="button"><a href="login.php" style="text-decoration: none;color: white">LOGIN</a></button>
    </form>
     </div>
    <div class="row">
        <table id="example" style="padding-left:-100px;" class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">City Name</th>
                <th scope="col">Image</th>


            </tr> 
            </thead>
            <tbody>
                <?php
                    $result = $user->readAll();
                    if($result->num_rows > 0){
                        while($row = $result->fetch_array()){
                            echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['first_name'] . "</td>";
                                echo "<td>" . $row['last_name'] . "</td>";
                                echo "<td>" . $row['user_city'] . "</td>";
                                echo "<td>" . "<img src =".$row['filepath']." width=\"50px\" height=\"50px\"></td>";

                                echo "<td><i class=\"fa fa-trash\"></i></td>";
                            echo "</tr>";
                        }
                    }
                    else
                        echo "<div>No records exist</div>";
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables            .min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

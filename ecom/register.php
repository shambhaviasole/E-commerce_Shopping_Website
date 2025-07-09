<?php

if(isset($_POST["register_button"]))
{

$connect = mysqli_connect("localhost:3007", "root", "", "sample");

$fn = $_POST["fullname"];
$eid = $_POST["email"];
$pwd = $_POST["password"];
$con = $_POST["contact"];
$age = $_POST["age"];

$filename = $_FILES["photo"]["tmp_name"];
$orgname = $_FILES["photo"]["name"];
$filesize = $_FILES["photo"]["size"];

$fileinfo = explode(".", $orgname);

$fileext = strtolower($fileinfo[1]);

$allowtypes = array('jpg', 'png', 'jpeg');

if(in_array($fileext, $allowtypes))
{        
    if($filesize > 100000 && $filesize < 500000 )
    {
        move_uploaded_file($filename, "user_images/".$orgname);

        $qry = "INSERT INTO `user`(`fullname`, `email`, `password`, `contact`, `age`, `photo`) VALUES ('$fn','$eid','$pwd','$con','$age','$orgname')";

         $result = mysqli_query($connect, $qry);

        if($result)
        {
            echo "Register Success";
        }
        else
        {
            echo "Failed to Register";
        }
    }
    else
    {
        echo "Invalid file size";
    }
}
else
{
    echo "Invalid Extension";
}


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card border-light p-4">
                    <h2 class="text-center mb-4">Registration Form</h2>
                    <form id="registrationForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" class="form-control" id="contact" name="contact">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="register_button">Register</button>
                        <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>



<!-- Steps to insert values in the database

1. Connection with database and should have connection variable // $connect
2. get the values in the variable which is entered by user. ($_POST["nameattribute"])
3. Write query to insert record     //$qry ="sql statement" insert into student
4. execute query        //mysqli_query($connect, $qry)      //MySQL - student
5. (optional) you can fetch no of rows affcted -- //mysqli_num_rows()
6. Acknoledgement print -->


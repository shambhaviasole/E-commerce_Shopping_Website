<?php
session_start();
if(isset($_SESSION["sid"]))		
{
	header("location:user.php");
}
else if(isset($_SESSION["admineid"]))
{
    header("location:admin/admindashboard.php");
}


if(isset($_POST["login_button"]))	
{


$connect = mysqli_connect("localhost:3307","root","","sample");

$eid = mysqli_real_escape_string($connect, $_POST["email"]);
$pwd = mysqli_real_escape_string($connect, $_POST["password"]);	

$qry = "select * from user where email = '$eid' AND password = '$pwd'";


if($eid=="admin@gmail.com" && $pwd == "admin")
{
    $_SESSION["admineid"] = $eid;
    header("location:admin/admindashboard.php");
}

else {
            $result = mysqli_query($connect, $qry);

            $rows = mysqli_num_rows($result);

            $data = mysqli_fetch_assoc($result);

            $id = $data["id"];

            if($rows>0)
            {
            		session_start();
            		$_SESSION["sid"] = $id;
            		header("location:user.php");		
            }
            else
            {
            	echo "Invalid email or password";
            }

}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
                    <h2 class="text-center mb-4">Login Form</h2>
                    <form id="registrationForm" method="post">
                   
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary btn-block" name="login_button">Login</button>
                        <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register here</a></p>
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
    <!-- <script src="js/script.js"></script> -->
</body>
</html>



<!-- Steps to insert values in the database

1. Connection with database and should have connection variable // $connect
2. get the values in the variable which is entered by user. ($_POST["nameattribute"])
3. Write query to insert record     //$qry ="sql statement" insert into student
4. execute query        //mysqli_query($connect, $qry)      //MySQL - student
5. (optional) you can fetch no of rows affcted -- //mysqli_num_rows()
6. Acknoledgement print -->


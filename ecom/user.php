<?php
session_start();
if(!isset($_SESSION["sid"]))
{
	header("location:index.php");
}

include("include/dbconnect.php");

$id = $_SESSION["sid"];		

$qry = "select * from user where id = '$id'";

$result = mysqli_query($connect, $qry);

$data = mysqli_fetch_assoc($result);

$imagepath = "user_images/".$data['photo'];



/*this code for change password*/
if(isset($_POST["update_password_button"]))
{

	$op = $_POST["op"];		//retriving old password
	$np = $_POST["np"];
	$rp = $_POST["rp"];



	if($op==$data["password"])
	{
		if($np==$rp)
		{
			if($np!=$data["password"])
			{
				$qry = "UPDATE `user` SET `password`= '$np' WHERE id = '$id'";
				$result = mysqli_query($connect, $qry);
				if($result)
				{
					?><script> alert("Password Changed Successfully"); </script><?php
				}
				else
				{
					?><script> alert("Something went wrong"); </script> <?php
				}
			}
			else
			{
				?><script> alert("Password should not match with old password""); </script> <?php
			}
		}
		else
		{
			 ?><script> alert("Password do not match, reenter password"); </script> <?php
		}
	}
	else
	{
		?><script> alert("Incorrect Old Password"); </script> <?php
	}
}
/*end logic*/

// update profile logic

if(isset($_POST["edit_button"]))
{
	$fn = $_POST["fullname"];
	$eid = $_POST["email"];
	$cn = $_POST["contact"];
	$age = $_POST["age"];

	$qry = "UPDATE `user` SET `fullname`='$fn',`email`='$eid',`contact`='$cn',`age`='$age' WHERE id = '$id'";
	$result = mysqli_query($connect, $qry);
	if($result)
	{
		?> <script> alert("Updated Successfully"); </script> <?php
	}
	else
	{
		?> <script> alert("Failed to update data"); </script> <?php
	}

}

//end logic





?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link href="css/style.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar w/ text</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
    </ul>
    <span class="navbar-text">
      <a href="logout.php"> Logout </a> (<?php echo $data["fullname"]; ?>)
    </span>
  </div>
</nav>


<div class="row">
	<div class="col-md-3">
		<ul class="list-group sidebar">
		  <li class="list-group-item"><a href="#userprofile" data-toggle="tab"> User Profile </a></li>
		  <li class="list-group-item"> <a href="#editprofile" data-toggle="tab"> Edit Profile </a> </li>
		  <li class="list-group-item"> <a href="#changepwd" data-toggle="tab"> Change Password </a> </li>
		  <li class="list-group-item"><a href="#orderhistory" data-toggle="tab"> Order History </a> </li>
		  <li class="list-group-item"><a href="logout.php"> Logout </a></li>

		</ul>
	</div>

	<div class="col-md-9">
		<div class="tab-content">
			<div class="tab-pane active" id="userprofile">

				<?php include("userprofile.php"); ?>

			</div>
			<div class="tab-pane" id="editprofile">
			<div class="container px-5">	
			<h2> Edit Profile </h2>
			<form id="registrationForm" method="post">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value=" <?php echo $data['fullname'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email'] ?>" required>
                        </div>
                      
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $data['contact'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $data['age'] ?>">
                        </div>
                    
                        <button type="submit" class="btn btn-primary btn-block" name="edit_button">Update</button>
                        
                    </form>
                </div>






			</div>
			<div class="tab-pane" id="changepwd">
				<div class="row align-items-center" style="height: 80vh;">
					<div class="col-md-4 mx-auto">
						<h4> Change Password </h4>
						<form method="post">
							<input type="password" placeholder="Old Password" class="form-control" id="op" name="op">
							<input type="password" placeholder="New Password" class="form-control" id="np" name="np">
							<div id="np-message" class="password-message"></div>
							<input type="password" placeholder="Reenter Password" class="form-control" id="rp" name="rp">
							<div id="rp-message" class="password-message"></div>
							<button type="submit" class="btn btn-outline-primary" id="update_password_button" name="update_password_button" disabled>Update Password</button>



						</form>
					</div>
				</div>

			</div>
			<div class="tab-pane" id="orderhistory">
					<?php include("orderhistory.php"); ?>
			</div>
		</div>



	</div>
</div>










<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>
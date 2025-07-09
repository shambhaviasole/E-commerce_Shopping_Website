<?php
$connect = mysqli_connect("localhost:3307","root","","sample");

if(!$connect)
{
	die("Can not connected -".mysql_error());
}

?>
<?php
session_start();


if(isset($_SESSION["sid"])) {
    unset($_SESSION["sid"]);
}

if(isset($_SESSION["admineid"])) {
    unset($_SESSION["admineid"]);
}

header("Location: index.php");
exit; // Ensure that script execution stops after redirection
?>

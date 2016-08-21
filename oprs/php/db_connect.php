<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$database = "oprs";

$conn = mysqli_connect($localhost, $username, $password, $database);
if ( mysqli_connect_error() ) {
    echo "Connection failed!<br />Error: ".mysqli_connect_error();
    die();
    }
echo "Connection Succesfully!";

//mysqli_select_db($conn, $database) or die("unable to connect database");
//$mydomain = "http://oprs.byethost9.com";
//session_start();
?>
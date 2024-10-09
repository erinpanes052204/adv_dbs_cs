<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "cs_ad";
$con = mysqli_connect($server, $username,$password,$dbname);

if(!$con){
    echo "Failed";
}
?>
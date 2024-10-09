<?php
session_start();

if(isset($_SESSION['adding'])){
    $id = $_GET['id'];
}

header('location:products.php');
?>
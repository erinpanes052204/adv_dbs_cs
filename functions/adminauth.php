<?php
session_start();
if(isset($_SESSION['auth'])){
    if($_SESSION['role_as']==0){
        $_SESSION['message'] = "You aint admin bruv";
        header('location:dahsboard.php');
    }
}else{
    $_SESSION['message'] = "LOGIN to continue!";
    header('location:login.php');
}
?>
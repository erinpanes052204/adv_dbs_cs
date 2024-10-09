<?php
session_start();
include('../conn.php');


if (isset($_POST['register-btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $check_email = "SELECT email from users where email = '$email' ";
    $check_email_run = mysqli_query($con, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $_SESSION['message'] = "Oi! Nagamit na email gago!";
        header('location:../register.php');
    } else {

        if ($password == $cpassword) {
            $insert_query = "INSERT INTO users (name,email,phone,password) VALUES ('$name','$email','$phone','$password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $_SESSION['message'] = "REGISTER SUCCESSFULLY";
                header('location:../login.php');
            } else {
                $_SESSION['message'] = "SOMETHING WENT WRONG!!";
                header('location:../register.php');
            }
        } else {
            $_SESSION['message'] = "PASSWORD NOT MATCHING BITCH!!";
            header('location:../register.php');
        }
    }
} else if (isset($_POST['login-btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM users WHERE email = '$email' AND password='$password'";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_assoc($login_query_run);
        $username = $userdata['name'];
        $useremail = $userdata['email'];
        $role_as = $userdata['role_as'];

        $_SESSION['auth_user'] = [
            'name' => $username,
            'email' => $useremail,
            'role' => $role_as
        ];

        $_SESSION['role_as'] = $role_as;

        if ($role_as == 1) {
            $_SESSION['message'] = "LOGIN SUCCESSFULLY!";
            header('location:../dash/dashboard.php');
        } else {
            // Handle other roles here
            $_SESSION['message'] = "LOGIN SUCCESSFULLY!";
            header('location:../dash/dashboard.php');
        }
    } else {
        $_SESSION['message'] = "INVALID!";
        header('location:../login.php');
    }
}


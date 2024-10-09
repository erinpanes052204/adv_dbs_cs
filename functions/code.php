<?php

include('../conn.php');
include('redirect.php');

if(isset($_POST['add-category'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $image = $_FILES['img']['name'];
    $status = isset($_POST['status']) ? '1': '0';

    $path = "../uploads";
    $image_ext = pathinfo($image,PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $category_query = "INSERT INTO categories(name,description,status,image) values ('$name','$desc','$filename','$status')";
    $cat_query_run = mysqli_query($con, $category_query);
    
    if($cat_query_run){
        move_uploaded_file($_FILES['img']['temp_name'], $path.'/'.$filename);
        redirect("../dash/categories.php", "Success.");
    }else{
        redirect("../dash/categories.php", "Something went wrong.");
    }
}
?>
<?php
include('../../conn.php');
include('functions.php');

if (isset($_POST['add-category'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];

    $user = $_POST['user_name'];


    $category_query = "INSERT INTO categories(name,description) values ('$name','$desc')";
    $cat_query_run = mysqli_query($con, $category_query);

    if ($cat_query_run) {
        $action = $user . " added a new category " . $name;

        if ($cat_query_run) {
            
            $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
            $log_cat_query_run = mysqli_query($con, $log_cat_query);
        }
        redirect("../categories.php", "Success.");
    } else {
        redirect("../categories.php", "Failed to insert category.");
    }
} elseif (isset($_POST['update-btn'])) {
    $category_id = $_POST['category-id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $user = $_POST['user_name'];
    $oldname = $_POST['old-name'];
    $olddesc = $_POST['old-desc'];

    // Update database with new category information
    $update_query = "UPDATE categories SET name='$name', description='$desc' WHERE id='$category_id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if($oldname != $name){
            $action = $user . " updated the name of the category ".$oldname .  "to " . $name;
        }elseif($olddesc != $desc){
            $action = $user . " updated the description of the category ". $name;
        }elseif($oldname != $name && $olddesc != $desc){
            $action = $user . " updated the name of the category".$oldname .  "to " . $name. "and updated the description of the category.";
        }
        else{
            $action = "";
        }
        if ($update_query_run && $action != "") {
            
            $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
            $log_cat_query_run = mysqli_query($con, $log_cat_query);
        }

        redirect("../categories.php?id=$category_id", "Category Updated Successfully");
    } else {
        redirect("../categories.php?id=$category_id", "Category Update Failed");
    }
} elseif (isset($_POST['delete-cat-btn'])) {
    $name = $_POST['old-name'];
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $delete_query = "DELETE FROM categories WHERE id='$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);
    $user = $_POST['user_name'];

    if ($delete_query_run) {
        $action = $user . " deleted the category " . $name;

        if ($delete_query_run) {
            
            $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
            $log_cat_query_run = mysqli_query($con, $log_cat_query);
        }
        redirect("../categories.php", "Category Deleted.");
    } else {
        redirect("../categories.php", "Failed.");
    }
} elseif (isset($_POST['add-item'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $qty = $_POST['qty'];

    $e_date = $_POST['e-date'];

    $user = $_POST['user_name'];

    if ($name != "" && $desc != "") {
        $inv_query = "INSERT INTO inventory(category_id,name,description,qty,expiry_date) VALUES ('$category_id','$name','$desc','$qty','$e_date')";
        $inv_query_run = mysqli_query($con, $inv_query);
        
        $action = $user . " added a new product " . $name. " x" . $qty;

        if ($inv_query_run) {
            
            $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
            $log_cat_query_run = mysqli_query($con, $log_cat_query);
        }
        redirect("../products.php", "Added Successfully.");
    } else {
        redirect("../products.php", "ALL FIELDS ARE MANDATORY.");
    }
} elseif (isset($_POST['update-item-btn'])) {
    $inv_id = $_POST['inv_id'];
    $category_id = $_POST['category_id'];
    $add_sub = $_POST['a'];
    $qty_amt = $_POST['qty-amt'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $qty = $_POST['qty'];
    $a_date = $_POST['a-date'];
    $e_date = $_POST['e-date'];

    $user = $_POST['user_name'];

    $oldcategory_id = $_POST['old-category'];
    $oldname = $_POST['old-name'];
    $olddesc = $_POST['old-desc'];
    $oldqty = $_POST['old-qty'];
    $olda_date = $_POST['old-acq-date'];
    $olde_date = $_POST['old-exp-date'];

    if ($name != "" && $desc != "") {
        if ($add_sub == "add") {
            $new_qty = $qty + $qty_amt;
        } elseif ($add_sub == "sub") {
            if ($qty != 0) {
                $new_qty = max($qty - $qty_amt, 0);
            } else {
                $new_qty = $qty;
            }
        } else {
            $new_qty = $qty;
        }

        $inv_query = "UPDATE inventory SET category_id='$category_id',  name='$name', description='$desc', qty='$new_qty', created_at='$a_date',expiry_date='$e_date' WHERE id='$inv_id'";
        $inv_query_run = mysqli_query($con, $inv_query);
        if($inv_query_run){
            if($oldname != $name){
                $action = $user . " updated the name of the item ".$oldname .  "to " . $name;
            }elseif($olddesc != $desc){
                $action = $user . " updated the description of the item ". $name;
            }elseif($oldqty != $new_qty){
                if($add_sub == "add"){
                    $action = $user . " added x". $qty_amt ." to ". $name;
                }elseif($add_sub == "sub"){
                    $action = $user . " removed x". $qty_amt ." from ". $name;
                }
            }elseif($olda_date != $a_date){
                $action = $user . " updated the acquiry date ". $olda_date ." to ". $a_date;
            }elseif($olde_date != $e_date){
                $action = $user . " updated the expiry date ". $olde_date ." to ". $e_date;
            }elseif($oldcategory_id != $category_id){
                $action = $user . " updated the expiry date ". $oldcategory_id ." to ". $category_id;
            
            }else{
                $action = "";
            }
            if ($inv_query_run && $action != "") {
                
                $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
                $log_cat_query_run = mysqli_query($con, $log_cat_query);
            }
        }
        redirect("../products.php", "Added Successfully.");
    } else {
        redirect("../products.php", "ALL FIELDS ARE MANDATORY.");
    }
} elseif (isset($_POST['delete-inv-btn'])) {

    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $delete_query = "DELETE FROM inventory WHERE id='$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);
    $name = $_POST['old-name'];
    $user = $_POST['user_name'];

    if ($delete_query_run) {
        $action = $user . " deleted the item " . $name;

        if ($delete_query_run) {
            
            $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
            $log_cat_query_run = mysqli_query($con, $log_cat_query);
        }
        redirect("../products.php", "Item Deleted.");
    } else {
        redirect("../products.php", "Failed.");
    }
} elseif (isset($_POST['add-user'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? '1' : '0';

    $user_name = $_POST['user_name'];

    if ($name != "" && $password != "") {
        $user_query = "INSERT INTO users(name,email,phone,password,role_as) VALUES ('$name','$email','$phone','$password','$role')";
        $user_query_run = mysqli_query($con, $user_query);
        if ($role == 1) {
            $action = $user_name . " added a new admin " . $name;
        } else {
            $action = $user_name . " added a new user " . $name;
        }

        if ($user_query_run) {
            $log_query = "INSERT INTO logs(user_name,action) VALUES ('$user_name','$action')";
            $log_query_run = mysqli_query($con, $log_query);
        }
        redirect("../users.php", "Added Successfully.");
    } else {
        redirect("../users.php", "ALL FIELDS ARE MANDATORY.");
    }
} elseif (isset($_POST['delete-user-btn'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $delete_query = "DELETE FROM users WHERE id='$id'";
    $delete_query_run = mysqli_query($con, $delete_query);
    $name = $_POST['old-name'];
    $user = $_POST['user_name'];

    if ($delete_query_run) {
        $action = $user . " deleted the user " . $name;

        if ($delete_query_run) {
            
            $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
            $log_cat_query_run = mysqli_query($con, $log_cat_query);
        }
        redirect("../users.php", "Item Deleted.");
    } else {
        redirect("../users.php", "Failed.");
    }
} elseif (isset($_POST['update-user-btn'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? '1' : '0';

    $user = $_POST['user_name'];

    $oldname = $_POST['old-name'];
    $oldemail = $_POST['old-email'];
    $oldphone = $_POST['old-phone'];
    $oldpassword = $_POST['old-password'];
    $oldrole = $_POST['old-role'];

    if ($name != "") {
        $inv_query = "UPDATE users SET name='$name', email='$email', phone='$phone',password='$password',role_as='$role' WHERE id='$id'";
        $inv_query_run = mysqli_query($con, $inv_query);
        if($oldname != $name){
            $action = $user . " updated the name of the user ".$oldname .  " to " . $name;
        }elseif($oldemail != $email){
            $action = $user . " updated the email of ". $name ." from". $oldemail. " to " . $email;
        }elseif($oldphone != $phone){
            $action = $user . " updated the email of ". $name ." from". $oldphone. " to " . $phone;
        }elseif($oldrole != $role){
            if($role == 1){
                $action = $user . " granted ". $name ." admin privellages";
            }else{
                $action = $user . " revoked ". $name ." admin privellages";
            }
            
        }
        else{
            $action = "";
        }
        if ($inv_query_run && $action != "") {
            
            $log_cat_query = "INSERT INTO logs(user_name,action) VALUES ('$user','$action')";
            $log_cat_query_run = mysqli_query($con, $log_cat_query);
        }
        redirect("../users.php", "Added Successfully.");
    } else {
        redirect("../users.php", "ALL FIELDS ARE MANDATORY.");
    }
} else {
    redirect("../../dashboard.php", "Invalid request.");
}

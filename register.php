<?php
session_start();

if(isset($_SESSION['auth'])){
    $_SESSION['message'] = "you are already logged in";
    header('location:home.php');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shakeys Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
      body{
    background-color:#343a40;
  }
</style>
<body>
    <?php include('conn.php') ?>
    <?php include('navbar.php') ?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php if(isset($_SESSION['message'])){?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong></strong> <?= $_SESSION['message']?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php } unset($_SESSION['message']);?>
                    <div class="card bg-dark text-warning">
                        <div class="card-header">
                            <center><h1>REGISTER</h1></center>
                        </div>
                        <div class="card-body ">
                            <form action="functions/authcode.php" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your Email" required
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone No.</label>
                                    <input type="number" name="phone" class="form-control" placeholder="Enter your phone number"required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your Password"required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password"required>
                                </div>
                                <div class="mb-3">
                                    <center><label class="form-label">Already have an account? </label>
                                    <a href="login.php" class="text-decoration-none text-warning">Login</a></center>
                                </div>
                                <center><button type="submit" name="register-btn" class="btn btn-warning w-50">Submit</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
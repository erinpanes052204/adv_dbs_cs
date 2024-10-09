<?php
session_start();

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
  <?php include('navbar.php');
  ?>

  <?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong></strong> <?= $_SESSION['message'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php }
  unset($_SESSION['message']); ?>
  <div class="container">
  <div class="row mb-5">
      <div class="col"></div>
      <div class="col">
      
      </div>
      <div class="col mb-5"></div>
    </div>
    <div class="row">
      <div class="col-3"><img src="images\MMD_yMF636T.png" alt=""></div>
      <div class="col-6 z-1">
      <img src="images\Shakeys_LOGO.png"  width="115%" alt="">
      </div>
      <div class="col-3"><img src="images\Promos_YJEXxHL.png" width="120%" alt=""></div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
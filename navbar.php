<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php"><img src="images\Shakeys_LOGO.png" width="130px" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
      <ul class="navbar-nav fs-1 ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <?php
        if (isset($_SESSION['auth'])) {
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['auth_user']['name'] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a type="button" class="btn btn-danger fs-1" href="login.php">Login</a>
          </li>
        <?php
        }
        ?>


      </ul>
    </div>
  </div>
</nav>
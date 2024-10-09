<?php
include('../functions/functions.php');
include('../header.php');
include('../sidebar.php');
?>

        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h1 class="text-end text-warning mb-5"><?= $_SESSION['auth_user']['name'] ?></h1>
                        <center><h3 class="fw-bold fs-2 mb-3 text-danger">EDIT USERS</h3></center>
                        <!-- Button trigger modal -->
                        <a href="users.php"  class="fs-4">
                        <i class="bi bi-arrow-left-circle-fill text-warning"></i>
                            <span class="text-warning">Go Back</span>
                        </a>
                        <div class="py-5">
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <div class="col-md-11">
                                        <?php if (isset($_GET['id'])) { 
                                            $id = $_GET['id'];
                                            $users = getByID("users",$id);

                                            if(mysqli_num_rows($users) > 0){
                                                    $data = mysqli_fetch_array($users)
                                            
                                            ?>
                                            <div class="card fs-5 bg-dark">
                                                <div class="card-body">
                                                    <form action="functions/code.php" method="post">
                                                    <div class="mb-3">
                                                    <input type="hidden" name="id" value="<?= $data['id'];?>">
                                                    <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name'] ?>">
                                                    <input type="hidden" name="old-name" value="<?= $data['name']; ?>">
                                                    <input type="hidden" name="old-email" value="<?= $data['email']; ?>">
                                                    <input type="hidden" name="old-phone" value="<?= $data['phone']; ?>">
                                                    <input type="hidden" name="old-role" value="<?= $data['role_as']; ?>">
                                                        <label for="exampleInputEmail1" class="form-label text-warning">Name:</label>
                                                        <input type="text" name="name" value="<?= $data['name']?>" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label  text-warning">Email:</label>
                                                        <input type="text" name="email" value="<?= $data['email']?>" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label  text-warning">Phone:</label>
                                                        <input type="number" name="phone" value="<?= $data['phone']?>" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label  text-warning">Password:</label>
                                                        <input type="number" name="password" value="<?= $data['password']?>" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label  text-warning">Admin:</label>
                                                        <input type="checkbox" name="role" <?= $data['role_as'] ? "checked":"";?> id="">
                                                    </div>
                                                        <center><button type="submit" name="update-user-btn" class="btn btn-warning fs-2 w-50">UPDATE</button></center>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php
                                            ?>
                                        <?php
                                            }else{
                                                echo "CATEGORY NOT FOUND";
                                            }

                                        }else{
                                            echo "ID missing from url........";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </main>
            <?php

include('../footer.php');
?>
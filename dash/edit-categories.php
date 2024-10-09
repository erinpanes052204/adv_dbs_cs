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
                        <center><h3 class="fw-bold fs-2 mb-3 text-danger">EDIT CATEGORIES</h3></center>
                        <!-- Button trigger modal -->
                        <a href="categories.php" type="button" class="fs-4">
                        <i class="bi bi-arrow-left-circle-fill text-warning"></i>
                            <span class="text-warning">Go Back</span>
                        </a>
                        <div class="py-5">
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <div class="col-md-11">
                                        <?php if (isset($_GET['id'])) { 
                                            $id = $_GET['id'];
                                            $category = getByID("categories",$id);

                                            if(mysqli_num_rows($category) > 0){
                                                    $data = mysqli_fetch_array($category)
                                            
                                            ?>
                                            <div class="card fs-5 bg-dark">
                                                <div class="card-body">
                                                    <form action="functions/code.php" method="post">
                                                        <div class="mb-3">
                                                        <input type="hidden" name="category-id" value="<?= $data['id'];?>">
                                                        <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name']?>">
                                                            <label for="exampleInputEmail1" class="form-label text-warning">Name:</label>
                                                            <input type="hidden" name="old-name" value="<?= $data['name'];?>">
                                                            <input type="text" value="<?= $data['name'];?>" name="name" class="form-control w-100">
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="hidden" name="old-desc" value="<?= $data['description'];?>">
                                                            <label for="exampleInputPassword1" class="form-label text-warning">Description:</label>
                                                            <textarea class="text-dark rounded" rows="2" cols="112" name="desc" placeholder="Enter Description" id=""><?= $data['description'];?></textarea>
                                                        </div>
                                                       <center> <button type="submit" name="update-btn" class="btn btn-warning fs-2 w-50">UPDATE</button></center>
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
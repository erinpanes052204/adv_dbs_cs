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
                <center>
                    <h3 class="fw-bold fs-2 mb-3 text-danger">EDIT INVENTORY ITEM</h3>
                </center>
                <!-- Button trigger modal -->
                <a href="products.php" type="button" class="fs-4">
                    <i class="bi bi-arrow-left-circle-fill text-warning"></i>
                    <span class="text-warning">Go Back</span>
                </a>
                <div class="py-5">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <?php if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $inventory = getByID("inventory", $id);

                                    if (mysqli_num_rows($inventory) > 0) {
                                        $data = mysqli_fetch_array($inventory)

                                ?>
                                        <div class="card fs-5 bg-dark">
                                            <div class="card-body">
                                                <form action="functions/code.php" method="post">
                                                    <input type="hidden" name="inv_id" value="<?= $data['id']; ?>">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="category-id" value="<?= $data['id']; ?>">
                                                        <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name'] ?>">
                                                        <input type="hidden" name="old-name" value="<?= $data['name']; ?>">
                                                        <input type="hidden" name="old-desc" value="<?= $data['description']; ?>">
                                                        <input type="hidden" name="old-qty" value="<?= $data['qty']; ?>">
                                                        <?php
                                                        if (isset($_SESSION['auth'])) {
                                                        ?>
                                                            <label for="exampleInputEmail1" class="form-label text-warning">Name:</label>
                                                            <input type="text" value="<?= $data['name']; ?>" <?php if ($_SESSION['auth_user']['role'] == 0){ ?>disabled <?php }?> name="name" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label text-warning">Description:</label>
                                                        <textarea class="text-dark" rows="2" cols="100" name="desc" <?php if ($_SESSION['auth_user']['role'] == 0){ ?>disabled <?php }?> placeholder="Enter Description" id=""><?= $data['description']; ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label text-warning">Category:</label>
                                                        <input type="hidden" name="old-category" value="<?= $data['category_id'] ?>">
                                                        <select name="category_id" <?php if ($_SESSION['auth_user']['role'] == 0){ ?>disabled <?php }?> class="form-select">
                                                            <option class="text-dark" selected>Select Category</option>

                                                            <?php
                                                            $categories = getALL("categories");
                                                            if (mysqli_num_rows($categories) > 0) {
                                                                foreach ($categories as $item) {
                                                            ?>

                                                                    <option value="<?= $item['id'] ?>" <?= $data['category_id'] == $item['id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "No category Available";
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <label for="exampleInputPassword1" class="form-label text-warning">Acquire Date: <?= $_SESSION['auth_user']['role']?></label>
                                                                <input type="hidden" name="old-acq-date" value="<?= $data['created_at']; ?>">
                                                                <input type="date" class="text-dark" name="a-date" value="<?= isset($data['created_at']) == true ? $data['created_at'] : '' ?>" id="">
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputPassword1" class="form-label text-warning">Expiry Date:</label>
                                                                <input type="hidden" name="old-exp-date" value="<?= $data['expiry_date']; ?>">
                                                                <input type="date" class="text-dark" name="e-date" value="<?= isset($data['expiry_date']) == true ? $data['expiry_date'] : '' ?>" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                        }

                                                ?>

                                                <div class="mb-3 text-dark">
                                                    <label for="exampleInputPassword1" class="form-label text-warning">Quantity: <?= $data['qty']; ?></label>
                                                    <input type="hidden" name="qty" value="<?= $data['qty']; ?>"><br>
                                                    <p>ADD: <input type="radio" name="a" value="add"> SUB: <input type="radio" name="a" value="sub"></p>
                                                    <input type="number" name="qty-amt" value="" class="form-control">
                                                </div>
                                                <center> <button type="submit" name="update-item-btn" class="btn btn-warning fs-2 w-50">UPDATE</button></center>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                        ?>
                                <?php
                                    } else {
                                        echo "PRODUCT NOT FOUND";
                                    }
                                } else {
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
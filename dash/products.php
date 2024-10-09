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

                <div class="card bg-dark text-danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="fw-bold fs-4 mb-3 text-danger">List of Inventory</h3>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 ">
                                <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ADD Item
                                </button>
                                <!-- Modal -->
                                <form action="functions/code.php" method="post" enctype="multipart/form-data">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-dark">
                                                <div class="modal-header text-warning">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Item</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <form>
                                                        <div class="mb-3">
                                                            <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name'] ?>">
                                                            <label for="exampleInputEmail1" class="form-label text-warning">Name:</label>
                                                            <input type="text" name="name" class="form-control text-dark" placeholder="Enter Name">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputPassword1" class="form-label text-warning">Description:</label>
                                                            <textarea class="text-dark" rows="5" cols="56" name="desc" placeholder="Enter Description" id=""></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputPassword1" class="form-label text-warning">Category:</label>
                                                            <select name="category_id" class="form-select">
                                                                <option selected>Select Category</option>

                                                                <?php
                                                                $categories = getALL("categories");
                                                                if (mysqli_num_rows($categories) > 0) {
                                                                    foreach ($categories as $item) {
                                                                ?>
                                                                        <option class="text-dark" value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                                                <?php
                                                                    }
                                                                } else {
                                                                    echo "No category Available";
                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputPassword1" class="form-label text-warning">Quantity:</label>
                                                            <input type="number" name="qty" class="form-control text-warning" placeholder="Enter the quantity">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputPassword1" class="form-label text-warning">Expiry Date:</label>
                                                            <input type="date" class="text-dark" name="e-date" id="">
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="add-item" class="btn btn-warning">ADD</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="row">

                                <div class="col-12 ">
                                    <table id="myTable" class="table table-dark table-bordered">
                                        <thead class="table-warning">
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Acquire_Date</th>
                                            <th>Expiry_Date</th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $inv = "SELECT i.id, i.category_id, i.name, i.description, i.qty, i.created_at, i.expiry_date, c.name AS category_name
                                                    FROM  inventory AS i
                                                    LEFT JOIN 
                                                    categories AS c ON i.category_id = c.id;";
                                            $inv_run = mysqli_query($con, $inv);

                                            if (mysqli_num_rows($inv_run) > 0) {
                                                foreach ($inv_run as $item) {
                                            ?>
                                                    <tr>
                                                        <td><?= $item['id'] ?></td>
                                                        <td><?= $item['category_name'] ?></td>
                                                        <td><?= $item['name'] ?></td>
                                                        <td><?= $item['description'] ?></td>
                                                        <td><?= $item['qty'] ?>
                                                        </td>
                                                        <td><?= $item['created_at'] ?> </td>
                                                        <td><?= $item['expiry_date'] ?> </td>
                                                        <td><label class="text-dark"><a class="btn btn-warning fs-7 mb-3" href="edit-inv.php?id=<?= $item['id'] ?>">
                                                                    Edit
                                                                </a></label>
                                                        </td>

                                                        <td>
                                                            <form action="functions/code.php" method="post">
                                                                <input type="hidden" name="category_id" value="<?= $item['id'] ?>">
                                                                <input type="hidden" name="old-name" value="<?= $item['name']; ?>">
                                                                <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name'] ?>">
                                                                <button name="delete-inv-btn" class="btn btn-light">
                                                                    Delete
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "NO RECORD";
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-12 col-md-4 ">

                                <!-- Modal -->
                                <form action="functions/code.php" method="post" enctype="multipart/form-data">
                                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content ">
                                                <div class="modal-header text-dark">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Quantity</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <form>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label text-dark">ADD:</label>
                                                            <input type="number" name="add-inv" class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="add-qty-btn" class="btn btn-primary">ADD</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    </main>
    <?php

    include('../footer.php');
    ?>
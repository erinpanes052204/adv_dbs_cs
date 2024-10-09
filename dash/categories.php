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
                        <h3 class="fw-bold fs-4 mb-3 ">List of Categories</h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            ADD Categories
                        </button>

                        <!-- Modal -->
                        <form action="functions\code.php" method="post" enctype="multipart/form-data">
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-dark ">
                                        <div class="modal-header text-warning">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">ADD CATEGORY</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-warning">
                                            <form>
                                                <div class="mb-3">


                                                    <label for="exampleInputEmail1" class="form-label text-warning">Name:</label>
                                                    <input type="text" name="name" placeholder="Enter name" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label text-warning">Description:</label>
                                                    <textarea class="text-dark" rows="5" cols="56" name="desc" placeholder="Enter Description" id=""></textarea>
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="add-category" class="btn btn-warning">ADD</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">

                            <div class="col-12 ">
                                <table id="myTable" class="table table-dark table-bordered">
                                    <thead class="table-warning">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Creation Date</th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $categ = getALL("categories");

                                        if (mysqli_num_rows($categ) > 0) {
                                            foreach ($categ as $item) {
                                        ?>
                                                <tr>

                                                    <td><?= $item['id'] ?></td>
                                                    <td><?= $item['name'] ?></td>
                                                    <td><?= $item['description'] ?></td>
                                                    <td><?= $item['created_@'] ?></td>
                                                    <td><label class="text-dark"><a class="btn btn-warning fs-7 mb-3" href="edit-categories.php?id=<?= $item['id'] ?>">
                                                                Edit
                                                            </a></label>
                                                    </td>
                                                    <td>
                                                        <form action="functions/code.php" method="post">
                                                            <input type="hidden" name="old-name" value="<?= $item['name']; ?>">
                                                            <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name'] ?>">
                                                            <input type="hidden" name="category_id" value="<?= $item['id'] ?>">
                                                            <button name="delete-cat-btn" class="btn btn-light">
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
                    </div>
                </div>



            </div>
        </div>
    </main>
    <?php

    include('../footer.php');
    ?>
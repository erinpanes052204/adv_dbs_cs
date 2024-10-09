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
                            <h3 class="fw-bold fs-4 mb-3">List of Users</h3>
                            <div class="row">

                                <div class="col-12">
                                    <div class="col-12 col-md-4 ">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            ADD USERS
                                        </button>

                                        <!-- Modal -->
                                        <form action="functions/code.php" method="post" enctype="multipart/form-data">
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header text-warning">

                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Users</h1>

                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="mb-3">
                                                                    <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name'] ?>">
                                                                    <label for="exampleInputEmail1" class="form-label text-warning">Name:</label>
                                                                    <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1" class="form-label text-warning">Email:</label>
                                                                    <input type="text" name="email" class="form-control" placeholder="Enter Your Email">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1" class="form-label text-warning">Phone:</label>
                                                                    <input type="number" name="phone" class="form-control" placeholder="Enter Your Phone Number">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1" class="form-label text-warning">Password:</label>
                                                                    <input type="number" name="password" class="form-control" placeholder="Enter Your Password">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputEmail1" class="form-label text-warning">Admin:</label>
                                                                    <input type="checkbox" name="role" id="">
                                                                </div>

                                                            </form>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" name="add-user" class="btn btn-warning">ADD</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-12 ">


                                    <table id="myTable" class="table table-dark table-bordered">
                                        <thead class="table-warning">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Password</th>
                                            <th>Roles</th>
                                            <th>Creation Date</th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $users = getALL("users");

                                            if (mysqli_num_rows($users) > 0) {
                                                foreach ($users as $item) {
                                            ?>
                                                    <tr>
                                                        <td><?= $item['id'] ?></td>
                                                        <td><?= $item['name'] ?></td>
                                                        <td><?= $item['email'] ?></td>
                                                        <td><?= $item['phone'] ?></td>
                                                        <td><?= $item['password'] ?></td>
                                                        <td><?= $item['role_as'] == '0' ? "Employee" : "Admin" ?></td>
                                                        <td><?= $item['created_@'] ?></td>
                                                        <td><label class="text-dark"><a class="btn btn-warning fs-7 mb-3" href="edit-users.php?id=<?= $item['id'] ?>">
                                                                    Edit
                                                                </a></label>
                                                        </td>
                                                        <td>
                                                            <form action="functions/code.php" method="post">
                                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                                <input type="hidden" name="old-name" value="<?= $item['name']; ?>">
                                                                <input type="hidden" name="user_name" value="<?= $_SESSION['auth_user']['name'] ?>">
                                                                <button name="delete-user-btn" class="btn btn-light">
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
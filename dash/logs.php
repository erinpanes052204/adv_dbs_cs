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
                        <h3 class="fw-bold fs-4 mb-3">Activity Logs</h3>
                        <div class="row">

                            <div class="col-12 ">


                                <table id="myTable" class="table table-dark table-bordered">
                                    <thead class="table-warning">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
                                        <?php


                                        $logs = "SELECT * FROM logs ORDER BY date DESC";
                                        $logs_run = mysqli_query($con, $logs);

                                        if (mysqli_num_rows($logs_run) > 0) {
                                            foreach ($logs_run as $item) {
                                        ?>
                                                <tr>
                                                    <td><?= $item['id'] ?></td>
                                                    <td><?= $item['user_name'] ?></td>
                                                    <td><?= $item['action'] ?></td>
                                                    <td><?= $item['date'] ?></td>
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
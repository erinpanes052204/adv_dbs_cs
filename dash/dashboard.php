<?php
include('../functions/functions.php');
include('../header.php');
include('../sidebar.php');
?>
        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h1 class="text-end text-warning"><?= $_SESSION['auth_user']['name'] ?></h1>
                        <h1 class="fw-bold mb-3 text-danger"> Dashboard</h1>
                        <center> <img src="images\Shakeys_LOGO.png" width="25%" alt="" class="mb-5"></center>
                        <div class="row">
                            <div class="col-12 col-md-4 ">
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="card bg-dark shadow-lg">
                                        <div class="card-body text-warning ">
                                            <?php
                                            $sql = "SELECT COUNT(*) AS item_count FROM users";
                                            $result = mysqli_query($con, $sql);
                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                            ?>
                                            <h2 class="mb-5">Total Users:</h2>
                                            <span class="fs-1 text-warning"> <?= $row['item_count'] ?> </span>
                                            <?php
                                            ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="card bg-dark shadow-lg">
                                        <div class="card-body text-warning">
                                            <?php
                                            $sql = "SELECT COUNT(*) AS item_count FROM categories";
                                            $result = mysqli_query($con, $sql);
                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                            ?>
                                            <h2 class="mb-5">Total Categories:</h2>
                                            <span class="fs-1 text-warning"> <?= $row['item_count'] ?> </span>
                                            <?php
                                            ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="card bg-dark shadow-lg">
                                        <div class="card-body text-warning">
                                            <?php
                                            $sql = "SELECT COUNT(*) AS item_count FROM inventory";
                                            $result = mysqli_query($con, $sql);
                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                            ?>
                                            <h2 class="mb-5">Items in Inventory:</h2>
                                            <span class="fs-1 text-warning"> <?= $row['item_count'] ?> </span>
                                            <?php
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    $sql = "SELECT id, name, qty FROM inventory WHERE qty < 5 ORDER BY qty LIMIT 3";
                                    $result = mysqli_query($con, $sql);
                                    ?>
                                    <div class="col-12">
                                        <div class="card bg-dark text-warning">
                                            <div class="card-body">
                                                <h3>Items need Restock:</h3>
                                                <table class="table table-dark table-striped-columns">
                                                    <caption class="bg-dark text-warning ps-2">List of Items that need restocking</caption>
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th class="">ID</th>
                                                            <th class="">Name</th>
                                                            <th class="">Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($item = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>";
                                                            echo "<td>" . $item['id'] . "</td>";
                                                            echo "<td>" . $item['name'] . "</td>";
                                                            echo "<td>" . $item['qty'] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="col">
                                    <?php
                                    $sql = "SELECT id, name, qty, created_at FROM inventory ORDER BY id DESC LIMIT 3";
                                    $result = mysqli_query($con, $sql);
                                    ?>
                                    <div class="col-12">
                                        <div class="card bg-dark text-warning">
                                            <div class="card-body">
                                                <h3>Latest Items Added:</h3>
                                                <table class="table table-dark table-striped-columns">
                                                    <caption class="bg-dark text-warning ps-2">List of Items that were recently added</caption>
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                            <th>Acquire Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($item = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>";
                                                            echo "<td>" . $item['id'] . "</td>";
                                                            echo "<td>" . $item['name'] . "</td>";
                                                            echo "<td>" . $item['qty'] . "</td>";
                                                            echo "<td>" . $item['created_at'] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col">
                                    <?php
                                    $sql = "SELECT id, name, qty, expiry_date FROM inventory ORDER BY expiry_date ASC LIMIT 3";
                                    $result = mysqli_query($con, $sql);
                                    ?>
                                    <div class="col-12">
                                        <div class="card bg-dark text-warning">
                                            <div class="card-body">
                                                <h3>Items Near Expiration:</h3>
                                                <table class="table table-dark table-striped-columns">
                                                    <caption class="bg-dark text-warning ps-2">List of Items that were recently added</caption>
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                            <th>Expiry Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($item = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>";
                                                            echo "<td>" . $item['id'] . "</td>";
                                                            echo "<td>" . $item['name'] . "</td>";
                                                            echo "<td>" . $item['qty'] . "</td>";
                                                            echo "<td>" . $item['expiry_date'] . "</td>";
                                                            echo "</tr>";
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
                    </div>
            </main>
            <?php

include('../footer.php');
?>
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="bi bi-grid-fill"></i>
            </button>
            <div class="sidebar-logo">
                <h5 class="text-white">CS-AD</h5>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item" id="on">
                <a href="dashboard.php" class="sidebar-link">
                    <i class="bi bi-bar-chart-steps"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php
            if (isset($_SESSION['auth'])) {
                if ($_SESSION['auth_user']['role'] == 1) {
            ?>
                    <li class="sidebar-item">
                        <a href="logs.php" class="sidebar-link">
                        <i class="bi bi-journal-text"></i>
                            <span>Update Logs</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="users.php" class="sidebar-link">
                            <i class="bi bi-person"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="categories.php" class="sidebar-link">
                            <i class="bi bi-grid-3x3-gap"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                <?php
                }
                ?>
                <li class="sidebar-item">
                    <a href="products.php" class="sidebar-link">
                        <i class="bi bi-boxes"></i>
                        <span>Products</span>
                    </a>
                </li>
        </ul>
        <div class="sidebar-footer">
            <a href="../logout.php" class="sidebar-link">
                <i class="bi bi-arrow-bar-left"></i>
                <span>
                    <h7>Logout</h7>
                </span>
            </a>
        </div>
    <?php
            }
    ?>


    </aside>
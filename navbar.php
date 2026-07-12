<?php

$current_page = basename($_SERVER['PHP_SELF']);
$is_logged_in = isset($_SESSION['email']); 
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-3">
    <a class="navbar-brand" href="index.php">ECCOMERCE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
        <ul class="navbar-nav align-items-lg-center">
            <li class="nav-item <?php echo $current_page === 'index.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php echo $current_page === 'products.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="products.php">All Products</a>
            </li>
            <li class="nav-item <?php echo $current_page === 'account.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="account.php">Account</a>
            </li>
            <?php if ($is_logged_in): ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

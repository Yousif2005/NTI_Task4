<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<header class="hero-header d-flex align-items-center justify-content-center text-center text-white">
    <div class="hero-content">
        <h1>Welcome to our store</h1>
        <a href="products.php" class="btn btn-lg btn-primary mt-3">Shop Now</a>
    </div>
</header>

</body>
</html>

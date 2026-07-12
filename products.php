<?php
session_start();

$products = [
    'product 1' => [
        'price' => '620',
        'img'   => 'product1.jpg',
        'desc'  => 'A comfortable and stylish item made with premium quality materials.'
    ],
    'product 2' => [
        'price' => '6500',
        'img'   => 'product2.jpg',
        'desc'  => 'Our best seller of the month, only a few pieces left in stock.'
    ],
    'product 3' => [
        'price' => '1200',
        'img'   => 'product3.jpg',
        'desc'  => 'A great everyday essential, built to last for years to come.'
    ],
    'product 4' => [
        'price' => '350',
        'img'   => 'product4.jpg',
        'desc'  => 'Affordable and reliable, offering excellent value for your money.'
    ],
    'product 5' => [
        'price' => '2999',
        'img'   => 'product5.jpg',
        'desc'  => 'The premium edition, packed with extra features you will love.'
    ],
    'product 6' => [
        'price' => '899',
        'img'   => 'product6.jpg',
        'desc'  => 'Compact, lightweight, and perfect for taking with you anywhere.'
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop - All Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container my-5">
    <h2 class="text-center mb-4">All Products</h2>

    <?php if (isset($_SESSION['email'])): ?>
        <p class="text-center text-muted">Welcome back, <?php echo htmlspecialchars($_SESSION['email']); ?>!</p>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($products as $product => $values): ?>
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100">
                    <img src="<?php echo htmlspecialchars($values['img']); ?>"
                         class="card-img-top"
                         alt="<?php echo htmlspecialchars($product); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-capitalize"><?php echo htmlspecialchars($product); ?></h5>
                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($values['desc']); ?></p>
                        <p class="product-price mb-2"><?php echo htmlspecialchars($values['price']); ?> EGP</p>
                        <button class="btn btn-outline-dark mt-auto">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="text-center py-3 bg-dark text-white">
    <p class="mb-0">&copy; <?php echo date('Y'); ?> MyShop. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
session_start();

$errors = [];


$is_logged_in = isset($_SESSION['email']);

// Log IN

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // --- Email validation ---
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // --- Password validation ---
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long.';
    }

    // --- If everything is valid, store data in session and redirect ---
    if (empty($errors)) {
        $_SESSION['email']    = $email;
        $_SESSION['password'] = $password;

        header('Location: products.php');
        exit;
    }
}

//  Sign UP

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profile_submit'])) {

    $username  = trim($_POST['username'] ?? '');
    $password  = trim($_POST['password'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $facebook  = trim($_POST['facebook'] ?? '');
    $twitter   = trim($_POST['twitter'] ?? '');
    $instagram = trim($_POST['instagram'] ?? '');

    // --- Username ---
    if (empty($username)) {
        $errors['username'] = 'Username is required.';
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $errors['username'] = 'Username must be 3-20 characters (letters, numbers, underscore only).';
    }

    // --- Password ---
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long.';
    }

    // --- Email ---
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // --- Phone number ---
    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required.';
    } elseif (!preg_match('/^01[0125][0-9]{8}$/', $phone)) {
        $errors['phone'] = 'Please enter a valid phone number (e.g. 01012345678).';
    }

    // --- Facebook URL ---
    if (empty($facebook)) {
        $errors['facebook'] = 'Facebook account URL is required.';
    } elseif (!filter_var($facebook, FILTER_VALIDATE_URL) || !preg_match('/facebook\.com/i', $facebook)) {
        $errors['facebook'] = 'Please enter a valid Facebook URL (e.g. https://facebook.com/username).';
    }

    // --- Twitter URL ---
    if (empty($twitter)) {
        $errors['twitter'] = 'Twitter account URL is required.';
    } elseif (!filter_var($twitter, FILTER_VALIDATE_URL) || !preg_match('/(twitter\.com|x\.com)/i', $twitter)) {
        $errors['twitter'] = 'Please enter a valid Twitter URL (e.g. https://twitter.com/username).';
    }

    // --- Instagram URL ---
    if (empty($instagram)) {
        $errors['instagram'] = 'Instagram account URL is required.';
    } elseif (!filter_var($instagram, FILTER_VALIDATE_URL) || !preg_match('/instagram\.com/i', $instagram)) {
        $errors['instagram'] = 'Please enter a valid Instagram URL (e.g. https://instagram.com/username).';
    }

    // --- If everything is valid, store data in session and redirect ---
    if (empty($errors)) {
        $_SESSION['username']  = $username;
        $_SESSION['password']  = $password;
        $_SESSION['email']     = $email;
        $_SESSION['phone']     = $phone;
        $_SESSION['facebook']  = $facebook;
        $_SESSION['twitter']   = $twitter;
        $_SESSION['instagram'] = $instagram;

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop - Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
<div class="account-wrapper">

    <?php if (!$is_logged_in): ?>

        <!-- LOGIN FORM  -->
        <div class="card account-card">
            <div class="card-header">Login to Your Account</div>
            <div class="card-body p-4">
                <form action="account.php" method="POST" novalidate>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text"
                               name="email"
                               id="email"
                               class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                               placeholder="you@example.com">
                        <?php if (isset($errors['email'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                               placeholder="Enter your password">
                        <?php if (isset($errors['password'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['password']; ?></div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="login_submit" class="btn btn-dark btn-block mt-3">Login</button>
                </form>
            </div>
        </div>

    <?php else: ?>

        <!-- PROFILE COMPLETION FORM -->
        <div class="card account-card">
            <div class="card-header">Complete Your Profile</div>
            <div class="card-body p-4">
                <form action="account.php" method="POST" novalidate>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username"
                               id="username"
                               class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($_POST['username'] ?? ($_SESSION['username'] ?? '')); ?>"
                               placeholder="Choose a username">
                        <?php if (isset($errors['username'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['username']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                               placeholder="Choose a password">
                        <?php if (isset($errors['password'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['password']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"
                               name="email"
                               id="email"
                               class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ($_SESSION['email'] ?? '')); ?>"
                               placeholder="you@example.com">
                        <?php if (isset($errors['email'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text"
                               name="phone"
                               id="phone"
                               class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($_POST['phone'] ?? ($_SESSION['phone'] ?? '')); ?>"
                               placeholder="01012345678">
                        <?php if (isset($errors['phone'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['phone']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="facebook">Facebook Account URL</label>
                        <input type="text"
                               name="facebook"
                               id="facebook"
                               class="form-control <?php echo isset($errors['facebook']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($_POST['facebook'] ?? ($_SESSION['facebook'] ?? '')); ?>"
                               placeholder="https://facebook.com/username">
                        <?php if (isset($errors['facebook'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['facebook']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="twitter">Twitter Account URL</label>
                        <input type="text"
                               name="twitter"
                               id="twitter"
                               class="form-control <?php echo isset($errors['twitter']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($_POST['twitter'] ?? ($_SESSION['twitter'] ?? '')); ?>"
                               placeholder="https://twitter.com/username">
                        <?php if (isset($errors['twitter'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['twitter']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="instagram">Instagram Account URL</label>
                        <input type="text"
                               name="instagram"
                               id="instagram"
                               class="form-control <?php echo isset($errors['instagram']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($_POST['instagram'] ?? ($_SESSION['instagram'] ?? '')); ?>"
                               placeholder="https://instagram.com/username">
                        <?php if (isset($errors['instagram'])): ?>
                            <div class="is-invalid-msg"><?php echo $errors['instagram']; ?></div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="profile_submit" class="btn btn-dark btn-block mt-3">Save Profile</button>
                </form>
            </div>
        </div>

    <?php endif; ?>

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

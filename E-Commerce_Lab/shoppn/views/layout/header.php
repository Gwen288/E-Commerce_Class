
<?php
// core.php should already be loaded before this header
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ShopPN</title>
    <link rel="stylesheet"  href="<?php echo BASE_URL; ?>css/style.css">

</head>

<body>

<header>

    <nav>

        <a href="<?php echo BASE_URL; ?>index.php">
            Shoppn
        </a>

        <a href="<?php echo BASE_URL; ?>index.php">
            Home
        </a>


        <?php if (is_logged_in()): ?>

            <span>
                Welcome,
                <?php echo htmlspecialchars($_SESSION['customer_name']); ?>
            </span>

            <a href="<?php echo BASE_URL; ?>views/account/my_account.php">
                My Account
            </a>

            <a href="<?php echo BASE_URL; ?>logout.php">
                Logout
            </a>


        <?php else: ?>

            <a href="<?php echo BASE_URL; ?>views/register.php">
                Register
            </a>

            <a href="<?php echo BASE_URL; ?>views/login.php">
                Login
            </a>

        <?php endif; ?>

    </nav>

</header>

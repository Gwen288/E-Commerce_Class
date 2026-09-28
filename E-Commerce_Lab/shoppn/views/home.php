<?php require_once __DIR__ . '/layout/header.php'; ?>

<main>

    <?php if (isset($_SESSION['success'])): ?>

        <div class="success-message">

            <?php echo htmlspecialchars($_SESSION['success']); ?>

        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>


    <?php if (isset($_SESSION['error'])): ?>

        <div class="error-message">

            <?php echo htmlspecialchars($_SESSION['error']); ?>

        </div>

        <?php unset($_SESSION['error']); ?>

    <?php endif; ?>


    <h1>Welcome to Shoppn</h1>

    <p>Home page coming soon.</p>

</main>

<?php require_once __DIR__ . '/layout/footer.php'; ?>


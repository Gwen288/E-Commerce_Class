<?php

require_once __DIR__ . '/../../core/core.php';
require_once __DIR__ . '/../../controllers/ProductController.php';

require_admin();

$controller = new ProductController();

$editId = $_GET['edit_id'] ?? null;
$editBrand = false;

/*
 * Check whether the page is in edit mode.
 */
if ($editId !== null) {

    if (
        !filter_var($editId, FILTER_VALIDATE_INT) ||
        (int)$editId <= 0
    ) {
        $_SESSION['error'] = 'Invalid brand ID.';
        redirect(BASE_URL . 'views/admin/brand.php');
    }

    $editId = (int)$editId;

    $editBrand = $controller->getBrandById($editId);

    if ($editBrand === false) {
        $_SESSION['error'] = 'Brand not found.';
        redirect(BASE_URL . 'views/admin/brand.php');
    }
}

/*
 * Get all brands for the table.
 */
$brands = $controller->getAllBrands();

require_once __DIR__ . '/../layout/header.php';
?>

<main>

    <h1>Manage Brands</h1>

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


    <?php if ($editBrand !== false): ?>

        <!-- EDIT MODE -->

        <h2>Edit Brand</h2>

        <form
            action="<?php echo BASE_URL; ?>actions/update_brand_action.php"
            method="POST"
        >

            <input
                type="hidden"
                name="brand_id"
                value="<?php echo htmlspecialchars($editBrand['brand_id']); ?>"
            >

            <label for="brand_name">
                Brand Name
            </label>

            <input
                type="text"
                id="brand_name"
                name="brand_name"
                value="<?php echo htmlspecialchars($editBrand['brand_name']); ?>"
                required
            >

            <button type="submit">
                Update Brand
            </button>

            <a href="<?php echo BASE_URL; ?>views/admin/brand.php">
                Cancel
            </a>

        </form>

    <?php else: ?>

        <!-- ADD MODE -->

        <h2>Add Brand</h2>

        <form
            action="<?php echo BASE_URL; ?>actions/add_brand_action.php"
            method="POST"
        >

            <label for="brand_name">
                Brand Name
            </label>

            <input
                type="text"
                id="brand_name"
                name="brand_name"
                required
            >

            <button type="submit">
                Add Brand
            </button>

        </form>

    <?php endif; ?>


    <h2>Existing Brands</h2>

    <?php if (count($brands) > 0): ?>

        <table>

            <thead>

                <tr>
                    <th>Brand ID</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($brands as $brand): ?>

                    <tr>

                        <td>
                            <?php echo htmlspecialchars($brand['brand_id']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($brand['brand_name']); ?>
                        </td>

                        <td>

                            <a
                                href="<?php echo BASE_URL; ?>views/admin/brand.php?edit_id=<?php echo (int)$brand['brand_id']; ?>"
                            >
                                Edit
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php else: ?>

        <p>No brands have been added yet.</p>

    <?php endif; ?>

</main>
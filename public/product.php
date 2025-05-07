<?php
session_start();

require_once '../classes/Product.php';

require_once '../template/header.php';
require_once '../template/nav.php';

$productObj = new Product();

/* read product id from the URL */
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    $id = 0;
}


$item = $productObj->find($id);

require_once '../template/header.php';

if (!$item) {
    echo 'Product not found.';
    exit;
}
?>

<div class="row product-page align-items-center gx-2">

    <div class="col-md-6 text-center">
        <img class="img-fluid mb-4" src="/images/products/<?php echo strtolower($item['name']); ?>.png"  alt="<?php echo htmlspecialchars($item['name']); ?>">
    </div>

    <div class="col-md-6">
        <h2><?php echo htmlspecialchars($item['name']); ?></h2>
        <p class="fw-bold fs-4 text-danger">€<?php echo number_format($item['price'], 2); ?></p>

        <p><strong>Stock:</strong> <?php echo $item['stock']; ?></p>

        <p><?php echo htmlspecialchars($item['description']); ?></p>

        <?php if (isset($_SESSION['user_id'])) { ?>

            <form method="post" action="add_to_cart.php" class="mb-3">
                <input type="hidden" name="id" value="<?php echo $item['product_id']; ?>">
                <input type="number" name="qty" value="1" min="1" max="<?php echo $item['stock']; ?>" class="form-control w-25 mb-2" required>
                <button class="btn btn-danger" type="submit">Add to Trolley</button>
                <a class="btn btn-outline-secondary" href="index.php">Back</a>
            </form>


        <?php } ?>


        <?php if (!isset($_SESSION['user_id'])) { ?>

            <a class="btn btn-warning" href="login.php">Log in to add to trolley</a>
            <a class="btn btn-outline-secondary" href="index.php">Back</a>

        <?php } ?>

    </div>
</div>



<?php require_once '../template/footer.php'; ?>

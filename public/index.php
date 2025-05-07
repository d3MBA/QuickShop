<?php
session_start();

require_once '../classes/Product.php';

$productObj = new Product();

if (isset($_GET['search'])) {
    $searchText = trim($_GET['search']);
} else {
    $searchText = '';
}


if ($searchText !== '') {
    $products = $productObj->search($searchText);
} else {
    $products = $productObj->all();
}

require_once '../template/header.php';
require_once '../template/nav.php';
?>

<div class="search-bar">
    <form class="input-group" method="get" action="index.php">
        <input class="form-control" type="text" name="search" placeholder="Search products…" value="<?php echo htmlspecialchars($searchText); ?>">
        <button class="btn btn-danger" type="submit">Search</button>
    </form>
</div>


<div class="row g-3">
    <?php if ($products) { ?>

        <?php foreach ($products as $p) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">

                    <a href="product.php?id=<?php echo $p['product_id']; ?>">
                        <img class="card-img-top" src="/images/products/<?php echo strtolower($p['name']); ?>.png"  alt="<?php echo htmlspecialchars($p['name']); ?>">
                    </a>

                    <div class="card-body">
                        <h6 class="card-title"><?php echo htmlspecialchars($p['name']); ?></h6>
                        <p class="fw-bold mb-2">€<?php echo number_format($p['price'], 2); ?></p>

                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <form method="post" action="add_to_cart.php">
                                <input type="hidden" name="id" value="<?php echo $p['product_id']; ?>">
                                <input type="number" name="qty" value="1" min="1" max="<?php echo $p['stock']; ?>" class="form-control mb-2" required>
                                <button class="btn btn-sm btn-outline-success" type="submit">Add to Trolley</button>
                            </form>
                        <?php } ?>

                        <?php if (!isset($_SESSION['user_id'])) { ?>
                            <a class="btn btn-sm btn-outline-success" href="login.php">Log in to add to trolley</a>
                        <?php } ?>
                    </div>


                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if (!$products) { ?>
        <p>No products found.</p>
    <?php } ?>

</div>




<?php require_once '../template/footer.php'; ?>

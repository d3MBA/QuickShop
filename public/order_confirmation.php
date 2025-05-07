<?php
session_start();

require_once '../classes/Product.php';
require_once '../classes/Order.php';

require_once '../template/header.php';
require_once '../template/nav.php';


if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    $id = 0;
}

?>


<div class="page-box text-center">
    <h3 class="mb-4">Order Confirmation</h3>
    <?php
    if ($id > 0) {
        echo '<p>Thank you! Order number is <strong>#' .$id. '</strong>.</p>';
    } else {
        echo '<p>Order not found.</p>';
    }
    ?>

    <a class="btn btn-primary mt-3" href="index.php">Continue Shopping</a>
    <a class="btn btn-primary mt-3" href="order_history.php">Check Order</a>
</div>


<?php require_once '../template/footer.php'; ?>

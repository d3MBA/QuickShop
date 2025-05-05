<?php
session_start();

require_once '../classes/Product.php';
require_once '../classes/Order.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

require_once '../template/header.php';
require_once '../template/nav.php';
?>

<h3>Order Confirmation</h3>

<?php
if ($id > 0) {
    echo '<p>Thank you! Your order number is <strong>#' . $id . '</strong>.</p>';
} else {
    echo '<p>Order not found.</p>';
}
?>

<a class="btn btn-primary" href="index.php">Continue Shopping</a>

<?php require_once '../template/footer.php'; ?>

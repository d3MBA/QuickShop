<?php
session_start();

require_once '../classes/Product.php';
require_once '../classes/Cart.php';
require_once '../template/header.php';
require_once '../template/nav.php';


if (isset($_POST['id'])) {
    $idRaw = $_POST['id'];
} else {
    $idRaw = '';
}

if (isset($_POST['qty'])) {
    $qtyRaw = $_POST['qty'];
} else {
    $qtyRaw = '';
}




if (!is_numeric($idRaw) || !is_numeric($qtyRaw)) {
    echo 'Invalid data.';
    exit;
}

$id = (int)$idRaw;
$qty = (int)$qtyRaw;

if ($qty < 1) {
    echo 'Quantity must be at least 1.';
    exit;
}

$productObj = new Product();
$item = $productObj->find($id);

if (!$item) {
    echo 'Product not found.';
    exit;
}

$stock = (int)$item['stock'];

if ($qty > $stock) {
    echo 'Only ' . $stock . ' in stock.';
    exit;
}



$cart = new Cart();
$cart->add($id, $qty);

header('Location: shopping_cart.php');
exit;

require_once '../template/footer.php';

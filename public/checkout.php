<?php
session_start();

require_once '../classes/Cart.php';
require_once '../classes/Product.php';
require_once '../classes/Order.php';

require_once '../template/header.php';
require_once '../template/nav.php';


$cartObj    = new Cart();
$productObj = new Product();
$orderObj   = new Order();

$cart = $cartObj->items();
if (!$cart) {
    echo 'Your trolley is empty.';
    exit;
}

$items = [];
foreach ($cart as $pid => $qty) {
    $p = $productObj->find($pid);
    if ($p) {
        $items[] = [
            'id'    => $pid,
            'qty'   => $qty,
            'price' => $p['price'],
            'name'  => $p['name']
        ];
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['address'])) {
        $addr = trim($_POST['address']);
    } else {
        $addr = '';
    }

    if (isset($_POST['del_date'])) {
        $date = $_POST['del_date'];
    } else {
        $date = '';
    }

    if (isset($_POST['del_time'])) {
        $time = $_POST['del_time'];
    } else {
        $time = '';
    }

    if (isset($_POST['payment'])) {
        $pay = $_POST['payment'];
    } else {
        $pay = '';
    }


    if ($addr === '') {
        $errors[] = 'Address required';
    }
    if ($date === '') {
        $errors[] = 'Date required';
    }
    if ($time === '') {
        $errors[] = 'Time required';
    }
    if (!in_array($pay, ['card', 'cash'])) {
        $errors[] = 'Select payment method';
    }

    if (!$errors) {
        $orderId = $orderObj->create($_SESSION['user_id'], $addr, $date, $time, $pay, $items);
        $_SESSION['cart'] = [];
        header('Location: order_confirmation.php?id=' . $orderId);
        exit;
    }
}

require_once '../template/header.php';
require_once '../template/nav.php';
?>

<h3 class="mb-4">Checkout</h3>

<?php
if ($errors) {
    echo '<div class="alert alert-danger"><ul>';
    foreach ($errors as $e) {
        echo '<li>' . htmlspecialchars($e) . '</li>';
    }
    echo '</ul></div>';
}
?>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Delivery Address</label>
        <textarea name="address" class="form-control" required><?php echo htmlspecialchars($_POST['address'] ?? ''); ?></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Delivery Date</label>
            <input type="date" name="del_date" class="form-control" required value="<?php echo htmlspecialchars($_POST['del_date'] ?? ''); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Delivery Time</label>
            <input type="time" name="del_time" class="form-control" required value="<?php echo htmlspecialchars($_POST['del_time'] ?? ''); ?>">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Payment Method</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="payment" value="card" required <?php if (($_POST['payment'] ?? '') === 'card') echo 'checked'; ?>>
            <label class="form-check-label">Card</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="payment" value="cash" required <?php if (($_POST['payment'] ?? '') === 'cash') echo 'checked'; ?>>
            <label class="form-check-label">Cash</label>
        </div>
    </div>

    <button class="btn btn-success">Complete Order</button>
</form>

<?php require_once '../template/footer.php'; ?>

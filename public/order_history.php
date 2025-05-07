<?php
session_start();

require_once '../classes/Order.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$orderObj = new Order();
$orders   = $orderObj->listByCustomer($_SESSION['user_id']);

require_once '../template/header.php';
require_once '../template/nav.php';
?>

<div class="page-box">
    <h3 class="mb-4">Orders</h3>

<?php if ($orders) { ?>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Time</th>
            <th>Payment</th>
            <th class="text-end">Total: (€)</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $o) { ?>
            <tr>
                <td><?php echo $o['order_id']; ?></td>
                <td><?php echo $o['delivery_date']; ?></td>
                <td><?php echo $o['delivery_time']; ?></td>
                <td><?php echo $o['payment_method']; ?></td>
                <td class="text-end"><?php echo number_format($o['total_amount'], 2); ?></td>
                <td><?php echo $o['status']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>

<?php if (!$orders) { ?>
    <p>You have no orders yet.</p>
<?php }
?>
</div>




<?php require_once '../template/footer.php'; ?>

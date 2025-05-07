<?php
session_start();

require_once '../classes/Staff.php';
require_once '../classes/Order.php';
require_once '../classes/User.php';

require_once '../template/header.php';
require_once '../template/nav.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['staff']) {
    header('Location: login.php');
    exit;
}

$staff = new Staff();
$orderObj = new Order();

/* --- actions --- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* delete */
    if (isset($_POST['del_id'])) {
        $orderObj->deleteOrder((int)$_POST['del_id']);
    }

    /* status update */
    if (isset($_POST['upd_id']) && isset($_POST['new_status'])) {
        $orderObj->updateStatus((int)$_POST['upd_id'], $_POST['new_status']);
    }

    header('Location: staff_panel.php');
    exit;
}

/* --- list orders --- */
if (isset($_GET['search'])) {
    $key = sanitize_input($_GET['search']);
} else {
    $key = '';
}


if ($key !== '') {
    $orders = $staff->searchOrders($key);
} else {
    $orders = $staff->allOrders();
}

require_once '../template/header.php';
require_once '../template/nav.php';
?>

<div class="page-box">
    <h3 class="mb-4">Staff – Orders</h3>

<form class="input-group mb-3" method="get">

    <input class="form-control" name="search" placeholder="Search by customer name" value="<?php echo htmlspecialchars($key); ?>">
    <button class="btn btn-outline-light">Search</button>

</form>

<?php if ($orders) { ?>
    <table class="table">

        <thead>
            <tr>
                <th>#</th><th>Customer</th><th>Date</th>
                    <th class="text-end">Total&nbsp;(€)</th><th>Status</th><th class="text-end">Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($orders as $o) { ?>
            <tr>
                <td><?php echo $o['order_id']; ?></td>
                <td><?php echo htmlspecialchars($o['name']); ?></td>
                <td><?php echo $o['delivery_date']; ?></td>
                <td class="text-end"><?php echo number_format($o['total_amount'], 2); ?></td>
                <td><?php echo $o['status']; ?></td>
                <td class="text-end">

                    <!-- status dropdown -->
                    <form method="post" style="display:inline">
                        <input type="hidden" name="upd_id" value="<?php echo $o['order_id']; ?>">
                        <select name="new_status" class="form-select d-inline w-auto">
                            <option <?php if ($o['status'] == 'Pending') { echo 'selected'; } ?>>Pending</option>
                            <option <?php if ($o['status'] == 'Shipped') { echo 'selected'; } ?>>Shipped</option>

                            <option <?php if ($o['status'] == 'Completed') { echo 'selected'; } ?>>Completed</option>
                        </select>
                        <button class="btn btn-sm btn-primary">Save</button>
                    </form>


                    <!-- delete button -->
                    <form method="post" style="display:inline">
                        <input type="hidden" name="del_id" value="<?php echo $o['order_id']; ?>">
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?');">Delete</button>
                    </form>


                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>


<?php if (!$orders) { ?>
    <p>No orders found.</p>
<?php } ?>
</div>


<?php require_once '../template/footer.php'; ?>

<?php
session_start();

require_once '../classes/Cart.php';
require_once '../classes/Product.php';

require_once '../template/header.php';
require_once '../template/nav.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?msg=Please+log+in+first');
    exit;
}

$cartObj    = new Cart();
$productObj = new Product();

/* handle removal */
if (isset($_POST['remove_id'])) {

    if (isset($_POST['remove_id'])) {
        $idRaw = $_POST['remove_id'];
    } else {
        $idRaw = '';
    }


    if (isset($_POST['remove_qty'])) {
        $qtyRaw = $_POST['remove_qty'];
    } else {
        $qtyRaw = '';
    }


    if (!ctype_digit($idRaw) || !ctype_digit($qtyRaw)) {
        echo 'Invalid data.';
        exit;
    }

    $pid = (int)$idRaw;
    $qty = (int)$qtyRaw;

    if ($qty < 1) {
        echo 'Quantity must be at least 1.';
        exit;
    }

    $cart = $cartObj->items();

    if (isset($cart[$pid])) {
        $current = $cart[$pid];
    } else {
        $current = 0;
    }


    if ($qty > $current) {
        echo 'You only have ' . $current . ' of that item in your trolley.';
        exit;
    }

    $cartObj->removeQty($pid, $qty);
    header('Location: shopping_cart.php');
    exit;
}

$cartItems = $cartObj->items();
$total     = 0;

require_once '../template/header.php';
require_once '../template/nav.php';
?>

<h3 class="mb-4">Your Trolley</h3>

<?php
if ($cartItems) {
    ?>
    <table class="table">


        <thead>
        <tr>
            <th>Product</th>
            <th class="text-center">Qty</th>
            <th class="text-end">Price</th>
            <th class="text-end">Subtotal</th>
            <th class="text-end">Remove</th>
        </tr>
        </thead>


        <tbody>
        <?php

        foreach ($cartItems as $pid => $qty) {
            $prod = $productObj->find($pid);

            if (!$prod) {
                continue;
            }

            $sub = $prod['price'] * $qty;
            $total += $sub;
            ?>

            <tr>
                <td><?php echo htmlspecialchars($prod['name']); ?></td>
                <td class="text-center"><?php echo $qty; ?></td>
                <td class="text-end">€<?php echo number_format($prod['price'], 2); ?></td>
                <td class="text-end">€<?php echo number_format($sub, 2); ?></td>
                <td class="text-end">
                    <form method="post" class="d-inline-flex">
                        <input type="hidden" name="remove_id" value="<?php echo $pid; ?>">
                        <input type="number" name="remove_qty" value="1" min="1" max="<?php echo $qty; ?>" class="form-control form-control-sm me-2" required>
                        <button class="btn btn-sm btn-outline-danger" type="submit">Remove</button>
                    </form>
                </td>
            </tr>

            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3" class="text-end">Total</th>
            <th class="text-end">€<?php echo number_format($total, 2); ?></th>
            <th></th>
        </tr>
        </tfoot>
    </table>

    <form method="get" action="checkout.php" class="text-end">
        <button class="btn btn-success">Checkout</button>
    </form>
    <?php

} else {
    ?> <p>Your trolley is empty.</p> <?php
}

require_once '../template/footer.php';


?>


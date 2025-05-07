<?php
class Cart
{
    public function __construct() // https://www.w3schools.com/php/php_oop_constructor.asp
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function add($id, $qty)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $qty;
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }

    public function removeQty($id, $qty) // method to remove qty from cart
    {
        if (!isset($_SESSION['cart'][$id])) {
            return;
        }

        if ($qty >= $_SESSION['cart'][$id]) {
            unset($_SESSION['cart'][$id]); //  remove item https://www.php.net/manual/en/function.unset.php
        } else {
            $_SESSION['cart'][$id] -= $qty; // remove qty
        }
    }

    public function items()
    {
        return $_SESSION['cart'];
    }
}

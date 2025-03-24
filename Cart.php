<?php

//  representing items in the cart
class CartItem
{
    public $product;
    public $quantity;

    public function __construct($product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getTotalPrice()
    {
        return $this->product->price * $this->quantity;
    }
}

class Cart
{
    public $cart_items = [];

    // add item to the cart
    public function addToCart($product, $quantity)
    {
        $this->cart_items[$product->product_id] = new CartItem($product, $quantity);
    }

    // remove item from the cart
    public function removeFromCart($product_id)
    {
        if (isset($this->cart_items[$product_id])) {
            unset($this->cart_items[$product_id]);
        }
    }

    // get total amount for the cart
    public function getTotalAmount()
    {
        $total = 0;
        foreach ($this->cart_items as $item) {
            $total += $item->getTotalPrice();
        }
        return $total;
    }

    // display cart items
    public function displayCart()
    {
        foreach ($this->cart_items as $item) {
            echo "<br>Product: " . $item->product->name;
            echo "<br>Quantity: " . $item->quantity;
            echo "<br>Price per item: $" . number_format($item->product->price, 2);
            echo "<br>Total: $" . number_format($item->getTotalPrice(), 2);
            echo "<br>---";
        }
        echo "<br>Cart Total: $" . number_format($this->getTotalAmount(), 2);
    }
}
?>

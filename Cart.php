<?php

class Cart
{
    public $cart_items = [];

    public function addToCart($product, $quantity)
    {
        $this->cart_items[$product->product_id] = [
            'product' => $product,
            'quantity' => $quantity
        ];
    }

    public function removeFromCart($product_id)
    {
        if (isset($this->cart_items[$product_id])) {
            unset($this->cart_items[$product_id]);
        }
    }

    public function getTotalAmount()
    {
        $total = 0;
        foreach ($this->cart_items as $item) {
            $total += $item['product']->price * $item['quantity'];
        }
        return $total;
    }

    public function displayCart()
    {
        foreach ($this->cart_items as $item) {
            echo "<br>Product: " . $item['product']->name;
            echo "<br>Quantity: " . $item['quantity'];
            echo "<br>Price per item: $" . number_format($item['product']->price, 2);
            echo "<br>Total: $" . number_format($item['product']->price * $item['quantity'], 2);
            echo "<br>---";
        }
        echo "<br>Cart Total: $" . number_format($this->getTotalAmount(), 2);
    }
}

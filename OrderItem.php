<?php

class OrderItem
{
    public $product;
    public $quantity;
    public $priceAtPurchase;

    public function OrderItem($product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->priceAtPurchase = $product->price;
    }

    public function getTotalPrice()
    {
        return $this->priceAtPurchase * $this->quantity;
    }
}

class Order
{
    public $order_id;
    public $user;
    public $order_items = [];
    public $total_amount;

    public function __construct($user)
    {
        $this->user = $user;
    }

    // add an item to the order
    public function addOrderItem($product, $quantity)
    {
        $this->order_items[] = new OrderItem($product, $quantity);
        $this->total_amount += $product->price * $quantity;
    }

    // display order details
    public function displayOrder()
    {
        echo "<br><strong>Order for:</strong> " . $this->user->name;
        echo "<br><strong>Total Amount:</strong> $" . number_format($this->total_amount, 2);
        echo "<br>--- Order Items ---<br>";
        foreach ($this->order_items as $item) {
            echo "<br>Product: " . $item->product->name;
            echo "<br>Quantity: " . $item->quantity;
            echo "<br>Price: $" . number_format($item->getTotalPrice(), 2);
            echo "<br>---";
        }
    }
}

?>

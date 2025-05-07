<?php

require_once '../src/db.php';

class Order
{
    private $db;

    public function __construct() // https://www.w3schools.com/php/php_oop_constructor.asp
    {
        global $conn;
        $this->db = $conn;
    }

    public function create($custId, $addr, $date, $time, $pay, $items)
    {
        $total = 0; // initialize total amount variable
        foreach ($items as $p) {
            $total += $p['price'] * $p['qty']; // calculate total amount
        }


        $sql = "INSERT INTO orders (customer_id, address, delivery_date, delivery_time, payment_method, total_amount) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$custId, $addr, $date, $time, $pay, $total]);
        $orderId = $this->db->lastInsertId();


        foreach ($items as $p) { // loop  each item in the order
            $sub = $p['price'] * $p['qty'];

            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price, price_at_purchase) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$orderId, $p['id'], $p['qty'], $p['price'], $sub]);



            // update stock
            $sql = "UPDATE products SET stock = stock - ? WHERE product_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$p['qty'], $p['id']]);
        }

        return $orderId;
    }


    public function listByCustomer($custId) // method to list orders by customer ID
    {
        $sql = "SELECT order_id, delivery_date, delivery_time, payment_method, total_amount, status FROM orders WHERE customer_id = ? ORDER BY order_id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$custId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($orderId, $newStatus) // method to update order status
    {
        $sql = "UPDATE orders SET status = ? WHERE order_id = ?"; // update order status

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newStatus, $orderId]);
    }


    public function deleteOrder($orderId) // delete order and its items
    {
        $sql = "DELETE FROM order_items WHERE order_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);

        $sql = "DELETE FROM orders WHERE order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);
    }
}

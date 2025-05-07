<?php


require_once '../classes/User.php';

class Staff extends User
{


    // list all orders
    public function allOrders()
    {
        $sql = "SELECT o.*, c.name FROM orders o JOIN customers c ON o.customer_id = c.customerID ORDER BY o.order_id DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // search orders by customer name
    public function searchOrders($key)
    {
        $sql = "SELECT o.*, c.name FROM orders o JOIN customers c ON o.customer_id = c.customerID WHERE c.name LIKE ? ORDER BY o.order_id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['%' . $key . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

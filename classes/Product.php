<?php
require_once '../src/db.php';

class Product
{
    private $db;

    public function __construct() // https://www.w3schools.com/php/php_oop_constructor.asp
    {
        global $conn;
        $this->db = $conn;
    }


    public function all() // get all products
    {
        $sql = "SELECT * FROM products";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function search($txt) // search products by name
    {
        $sql = "SELECT * FROM products WHERE name LIKE ?";


        $stmt = $this->db->prepare($sql);
        $stmt->execute(['%'.$txt.'%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function find($id) // find product by id (product details)
    {
        $sql = "SELECT * FROM products WHERE product_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}

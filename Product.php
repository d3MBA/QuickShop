<?php

include 'db.php'; // database connection file

class Product
{
    public $product_id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $stock;
    public $image;

    public function getProductName($product_id)
    {
        return $this->name;
    }

    public function getProductDescription($product_id)
    {
        return $this->description;
    }

    public function getProductPrice($product_id)
    {
        return $this->price;
    }

    public function getProductStock($product_id)
    {
        return $this->stock;
    }

    public function getProductCategory($product_id)
    {
        return $this->category_id;
    }

    public function getProductImage($product_id)
    {
        return $this->image;
    }

    public function setProductStock($product_id)
    {
        $this->stock = $product_id;
    }

}

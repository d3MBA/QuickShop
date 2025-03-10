<?php

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
    public function displayProduct()
    {
        echo "<br>---";
        echo "<br>Name: " . $this->getProductName($this->product_id);
        echo "<br>Description: " . $this->getProductDescription($this->product_id);
        echo "<br>Price: " . $this->getProductPrice($this->product_id);
        echo "<br>Category: " . $this->getProductCategory($this->product_id);
        echo "<br>Stock: " . $this->getProductStock();
        echo "<br>Image: " . $this->getProductImage();
        echo "<br>";
    }
}

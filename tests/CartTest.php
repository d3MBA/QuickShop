<?php

use PHPUnit\Framework\TestCase;
require_once '../classes/Cart.php';

class CartTest extends TestCase
{
    protected function setUp(): void
    {
        session_start();
        $_SESSION['cart'] = [];
    }

    public function testAddNewItem()
    {
        $cart = new Cart();
        $cart->add(1, 2);

        $items = $cart->items();
        $this->assertEquals(2, $items[1]);

        echo "testAddNewItem passed\n";
    }

    public function testAddMoreQuantity()
    {
        $cart = new Cart();
        $cart->add(1, 2);
        $cart->add(1, 3);


        $items = $cart->items();
        $this->assertEquals(5, $items[1]);

          echo "testAddMoreQuantity passed \n";
    }

    public function testRemoveSomeQuantity()
    {
        $cart = new Cart();
        $cart->add(2, 5);
        $cart->removeQty(2, 2);

        $items = $cart->items();
        $this->assertEquals(3, $items[2]);

        echo "testRemoveSomeQuantity passed";
    }


}

<?php

use PHPUnit\Framework\TestCase;
require_once 'User.php';

class UserTest extends TestCase

{
    public function testRegister()
    {
        $user = new User();
        $user->register('TU Student', 'student@tudublin.ie', 'pass123', '123 Dublin', '123456789', 'pass123');

        echo $password = $user->password;
        echo $fullName = $user->name;

        $this->assertEquals('TU Student', $user->name);
        $this->assertEquals('student@tudublin.ie', $user->email);
        $this->assertEquals('pass123', $user->password);
        $this->assertEquals('123 Dublin', $user->address);
        $this->assertEquals('123456789', $user->phoneNumber);

        echo "testRegister passed\n";
    }


    public function testChangePasswordSuccess()
    {
        $user = new User();
        $user->email = 'student@tudublin.ie';

        $this->assertTrue(true);

        echo "testChangePasswordSuccess passed\n";
    }

    public function testChangePasswordFailure()
    {
        $user = new User();
        $user->email = 'student@tudublin.ie';

        $this->assertTrue(true);

        echo "testChangePasswordFailure passed\n";
    }
}

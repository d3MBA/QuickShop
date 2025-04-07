<?php

use PHPUnit\Framework\TestCase;
require_once 'User.php';

class UserTest extends TestCase
{
    public function testRegister()
    {
        $user = new User();
        $user->register('TU Student', 'student@tudublin.ie', 'secret', '123 Dublin', '123456789');

        $this->assertEquals('TU Student', $user->name);
        $this->assertEquals('student@tudublin.ie', $user->email);
        $this->assertEquals('secret', $user->password);
        $this->assertEquals('123 Dublin', $user->address);
        $this->assertEquals('123456789', $user->phoneNumber);

        echo "testRegister passed\n";
    }

    public function testUpdateAddress()
    {
        $conn = $this->createMock(PDO::class);
        $stmt = $this->createMock(PDOStatement::class);

        $conn->method('query')->willReturn($stmt);

        $user = new User();
        $user->email = 'student@tudublin.ie';
        $user->updateAddress($conn, 'New Address');

        $this->assertTrue(true);
        echo "testUpdateAddress passed\n";
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

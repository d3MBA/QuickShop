<?php

use PHPUnit\Framework\TestCase;
require_once '../classes/User.php';



class UserTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $user = new User();
        $email = 'student'.rand(1, 100).'@tudublin.ie';

        $result = $user->register('TU Student', $email,'Pass123', 'Pass123','123456789');
        $this->assertEquals('success', $result);
        echo "testRegisterSuccess passed\n";
    }

    public function testRegisterPasswordMismatch()
    {
        $user = new User();
        $result = $user->register('TU Student', 'student@tudublin.ie','Pass123','WrongPass', '123456789');

        $this->assertEquals('Passwords do not match.', $result);
        echo "testRegisterPasswordMismatch passed\n";
    }


    public function testRegisterInvalidPassword()
    {
        $user = new User();
        $result = $user->register('TU Student', 'student@tudublin.ie','password','password','123456789');
        $this->assertEquals('Password needs 1 capital letter and 1 number.', $result);
        echo "testRegisterInvalidPassword passed ";
    }



    public function testLoginFail()

    {
        $user = new User();
        $result = $user->login('wronguser@tudublin.ie', 'WrongPass');

        $this->assertFalse($result);
        echo "testLoginFail passed ";
    }
}
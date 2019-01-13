<?php

namespace BaseTest;


use Base\User;

class UserTest extends \PHPUnit_Framework_TestCase
{

    public function testCanCreateUserObject() {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
    }
}
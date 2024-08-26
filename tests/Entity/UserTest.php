<?php

use App\Entity\User;
use Monolog\Test\TestCase;

class UserTest extends TestCase
{
    public function testSetUsername()
    {
        $user = new User();
        $this->assertNull($user->getUsername());

        $username = "user";
        $user->setUsername("user");
        $this->assertEquals($username, $user->getUsername());
    }

    public function testSetPassword()
    {
        $user = new User();
        $this->assertNull($user->getPassword());

        $password = "password";
        $user->setPassword("password");
        $this->assertEquals($password, $user->getPassword());
    }

    public function testSetRoles()
    {
        $user = new User();

        $roles = ["ROLE_USER"];
        $user->setRoles($roles);
        $this->assertEquals(array_merge($roles), $user->getRoles());
    }

    public function testCreatedAt()
    {
        $user = new User();

        $createdAt = new DateTimeImmutable();
        $user->setCreatedAt($createdAt);
        $this->assertEquals($createdAt->format("d/m/Y h:m:s"), $user->getCreatedAt()->format("d/m/Y h:m:s"));
    }
}
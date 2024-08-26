<?php

use App\Entity\Services;
use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
{
    public function testSetName()
    {
        $service = new Services();
        $this->assertNull($service->getName());

        $name = "name";
        $service->setName("name");
        $this->assertEquals($name,$service->getName());
    }

    public function testSetDescription()
    {
        $service = new Services();
        $this->assertNull($service->getDescription());

        $description = "description";
        $service->setDescription("description");
        $this->assertEquals($description,$service->getDescription());
    }

    public function testSetImg()
    {
        $service = new Services();
        $this->assertNull($service->getImg());

        $img = "img";
        $service->setImg("img");
        $this->assertEquals($img,$service->getImg());
    }
}
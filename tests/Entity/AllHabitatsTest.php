<?php

use App\Entity\AllHabitats;
use PHPUnit\Framework\TestCase;

class AllHabitatsTest extends TestCase
{
    public function testSetName()
    {
        $habitat = new AllHabitats();
        $this->assertNull($habitat->getName());

        $name = "habitat";
        $habitat->setName("habitat");
        $this->assertEquals($name, $habitat->getName());
    }

    public function testSetDescription()
    {
        $habitat = new AllHabitats();
        $this->assertNull($habitat->getDescription());

        $description = "description";
        $habitat->setDescription("description");
        $this->assertEquals($description, $habitat->getDescription());
    }

    public function testSetImg()
    {
        $habitat = new AllHabitats();
        $this->assertNull($habitat->getImg());

        $img = "img";
        $habitat->setImg("img");
        $this->assertEquals($img,$habitat->getImg());
    }

    public function testSetCommentaire()
    {
        $habitat = new AllHabitats();
        $this->assertNull($habitat->getCommentaire());

        $commentaire = "commentaire";
        $habitat->setCommentaire("commentaire");
        $this->assertEquals($commentaire,$habitat->getCommentaire());
    }
}
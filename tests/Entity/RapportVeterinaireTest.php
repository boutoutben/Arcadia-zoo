<?php

use App\Entity\Animal;
use App\Entity\RapportVeterinaire;
use PHPUnit\Framework\TestCase;

class RapportVeterinaireTest extends TestCase
{
    public function testSetDate()
    {
        $rapport = new RapportVeterinaire();
        
        $date = new DateTime();
        $rapport->setDate($date);
        $this->assertEquals($date->format("d/m/Y h:m:s"),$rapport->getDate()->format("d/m/Y h:m:s"));
    }

    public function testSetDetail()
    {
        $rapport = new RapportVeterinaire();
        $this->assertNull($rapport->getDetail());
        
        $detail = "detail";
        $rapport->setDetail($detail);
        $this->assertEquals($detail,$rapport->getDetail());
    }

    public function testSetAnimal()
    {
        $rapport = new RapportVeterinaire();
        $this->assertNull($rapport->getAnimal());
        
        $animal = new Animal();
        $rapport->setAnimal($animal);
        $this->assertEquals($animal,$rapport->getAnimal());
    }
}
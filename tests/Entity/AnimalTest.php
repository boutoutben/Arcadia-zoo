<?php

use App\Entity\AllHabitats;
use App\Entity\Animal;
use App\Entity\Races;
use App\Entity\RapportVeterinaire;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{
    public function testSetName()
    {
        $animal = new Animal();
        $this->assertNull($animal->getName());

        $name = "name";
        $animal->setName("name");
        $this->assertEquals($name, $animal->getName());
    }

    public function testSetEtat()
    {
        $animal = new Animal();
        $this->assertNull($animal->getEtat());

        $etat = "etat";
        $animal->setEtat("etat");
        $this->assertEquals($etat, $animal->getEtat());
    }

    public function testSetHabitat()
    {
        $animal = new Animal();
        $this->assertNull($animal->getHabitats());

        $habitat = new AllHabitats();
        $animal->setHabitats(new AllHabitats());
        $this->assertEquals($habitat, $animal->getHabitats());
    }

    public function testSetRace()
    {
        $animal = new Animal();
        $this->assertNull($animal->getRaces());

        $race = new Races();
        $animal->setRace(new Races());
        $this->assertEquals($race, $animal->getRaces());
    }

    public function testSetImg()
    {
        $animal = new Animal();
        $this->assertNull($animal->getImg());

        $img = "img";
        $animal->setImg("img");
        $this->assertEquals($img, $animal->getImg());
    }

    public function testSetDate()
    {
        $animal = new Animal();
        $this->assertNull($animal->getDate());

        $date = new DateTime();
        $animal->setDate(new DateTime());
        $this->assertEquals($date->format('d/m/Y h:m:s'), $animal->getDate()->format('d/m/Y h:m:s'));
    }

    public function testSetNourriture()
    {
        $animal = new Animal();
        $this->assertNull($animal->getNourriture());

        $nourriture = "nourriture";
        $animal->setNourriture("nourriture");
        $this->assertEquals($nourriture, $animal->getNourriture());
    }

    public function testSetQuantitee()
    {
        $animal = new Animal();
        $this->assertNull($animal->getQuantitee());

        $quantitee = 1;
        $animal->setQuantitee(1);
        $this->assertEquals($quantitee, $animal->getQuantitee());
    }

    public function testSetLastRapport()
    {
        $animal = new Animal();
        $this->assertNull($animal->getLastRapport());

        $lastRapport = new RapportVeterinaire();
        $animal->setLastRapport(new RapportVeterinaire());
    }

    public function testSetNbClick()
    {
        $animal = new Animal();
        $this->assertNull($animal->getNbClick());

        $nbClick = 2;
        $animal->setNbClick(2);
        $this->assertEquals($nbClick, $animal->getNbClick());
    }
}
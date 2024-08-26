<?php

use App\Entity\Races;
use PHPUnit\Framework\TestCase;

class RacesTest extends TestCase
{
    public function testSetLabel()
    {
        $races = new Races();
        $this->assertNull($races->getLabel());

        $label = 'label';
        $races->setLabel("label");
        $this->assertEquals($label,$races->getLabel());
    }
}
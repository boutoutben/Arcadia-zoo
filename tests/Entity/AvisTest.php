<?php

use App\Entity\Avis;
use PHPUnit\Framework\TestCase;

class AvisTest extends TestCase
{
    public function testSetPseudo()
    {
        $avis = new Avis();
        $this->assertNull($avis->getPseudo());

        $pseudo = "ben";
        $avis->setPseudo("ben");
        $this->assertEquals($pseudo, $avis->getPseudo());
    }

    public function testSetAvis()
    {
        $avis = new Avis();
        $this->assertNull($avis->getAvis());

        $avisText = "avis";
        $avis->setAvis("avis");
        $this->assertEquals($avisText, $avis->getAvis());
    }
    public function testSetValid()
    {
        $avis = new Avis();
        $this->assertNull($avis->isValid());

        $isvalid = true;
        $avis->setValid(true);
        $this->assertEquals($isvalid, $avis->isValid());
    }
}
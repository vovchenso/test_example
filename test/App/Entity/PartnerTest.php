<?php

use App\Entity\Partner;

class PartnerTest extends \PHPUnit_Framework_TestCase
{
    public function testEntity()
    {
        $oPartner = new Partner();
        $oPartner->sName = 'Test Name';
        $oPartner->sHomepage = 'https://test.com';
        
        $this->assertEquals('Test Name', $oPartner->sName);
        $this->assertEquals('https://test.com', $oPartner->sHomepage);
        $this->assertInternalType('array', $oPartner->aPrices);
        $this->assertEmpty($oPartner->aPrices);
    }
}

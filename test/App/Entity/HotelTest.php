<?php

use App\Entity\Hotel;

class HotelTest extends \PHPUnit_Framework_TestCase
{
    public function testEntity()
    {
        $oHotel = new Hotel();
        $oHotel->sName = 'Test Name';
        $oHotel->sAdr = 'Test Adr';
        
        $this->assertEquals('Test Name', $oHotel->sName);
        $this->assertEquals('Test Adr', $oHotel->sAdr);
        $this->assertInternalType('array', $oHotel->aPartners);
        $this->assertEmpty($oHotel->aPartners);
    }
}

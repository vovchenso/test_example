<?php

use App\Service\DataSorter\PartnerNameDataSorter;
use App\Entity\Hotel;
use App\Entity\Partner;

class PartnerNameDataSorterTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $oSorter = new PartnerNameDataSorter();
        $this->assertInstanceOf('App\Service\DataSorter\DataSorterInterface', $oSorter);
    }
    
    public function testSort()
    {
        $oPartner1 = new Partner;
        $oPartner1->sName = 'c';
        $oPartner2 = new Partner;
        $oPartner2->sName = 'x';
        $oPartner3 = new Partner;
        $oPartner3->sName = 'a';
        
        $oHotel = new Hotel;
        
        $oHotel->aPartners = array($oPartner1, $oPartner2, $oPartner3);
        
        $oSorter = new PartnerNameDataSorter();
        $aServiceResult = $oSorter->sort(array($oHotel));
        
        $this->assertInternalType('array', $aServiceResult);
        
        $oHotelResult = current($aServiceResult);
        $aResultPartners = $oHotelResult->aPartners;
        
        $this->assertInternalType('array', $aResultPartners);
        $this->assertCount(3, $aResultPartners);
        
        $this->assertEquals($oPartner3, $aResultPartners[0]);
        $this->assertEquals($oPartner1, $aResultPartners[1]);
        $this->assertEquals($oPartner2, $aResultPartners[2]);
    }
}

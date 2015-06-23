<?php

use App\Service\DataSorter\PriceDataSorter;
use App\Entity\Hotel;
use App\Entity\Partner;
use App\Entity\Price;

class PriceDataSorterTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $oSorter = new PriceDataSorter();
        $this->assertInstanceOf('App\Service\DataSorter\DataSorterInterface', $oSorter);
    }
    
    public function testSort()
    {
        $aPrices = array();
        
        for ($i = 3; $i > 0; $i--) {
            $oPrice = new Price;
            $oPrice->fAmount = $i;
            $aPrices[] = $oPrice;
        }
        
        $oPartner1 = new Partner;
        $oPartner1->aPrices = $aPrices;
        
        $oHotel = new Hotel;
        $oHotel->aPartners = array($oPartner1);
        
        $oSorter = new PriceDataSorter();
        $aServiceResult = $oSorter->sort(array($oHotel));
        
        $this->assertInternalType('array', $aServiceResult);
        
        $oHotelResult = current($aServiceResult);

        $aResultPartners = $oHotelResult->aPartners;
        $this->assertInternalType('array', $aResultPartners);
        
        $oPartnerResult = current($aResultPartners);
        $aPricesResult = $oPartnerResult->aPrices;
        
        $this->assertInternalType('array', $aPricesResult);
        $this->assertCount(3, $aPricesResult);
        
        $this->assertEquals($aPrices[2], $aPricesResult[0]);
        $this->assertEquals($aPrices[1], $aPricesResult[1]);
        $this->assertEquals($aPrices[0], $aPricesResult[2]);
    }
}

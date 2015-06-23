<?php

use App\Entity\Price;

class PriceTest extends \PHPUnit_Framework_TestCase
{
    public function testEntity()
    {
        $from = '2012-10-12';
        $to = '2012-10-13';
        
        $oPrice = new Price();
        $oPrice->sDescription = 'Test Description';
        $oPrice->fAmount = 100;
        $oPrice->oFromDate = new \DateTime($from);
        $oPrice->oToDate = new \DateTime($to);
        
        $this->assertEquals('Test Description', $oPrice->sDescription);
        $this->assertEquals(100, $oPrice->fAmount);
        $this->assertInstanceOf('DateTime', $oPrice->oFromDate);
        $this->assertInstanceOf('DateTime', $oPrice->oToDate);
        $this->assertEquals($from, $oPrice->oFromDate->format('Y-m-d'));
        $this->assertEquals($to, $oPrice->oToDate->format('Y-m-d'));
    }
}

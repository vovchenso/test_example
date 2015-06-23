<?php

use App\Service\UnorderedHotelService;

class UnorderedHotelServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \App\Service\PartnerService
     */
    public $oPartnerService;
    
    public function setUp()
    {
        $oProviderMock = $this->getMock('App\Service\DataProvider\FileDataProvider');
        $this->oPartnerService = $this->getMock('App\Service\PartnerService', array(), [$oProviderMock]);
    }
    
    public function testConstructor()
    {
        $oService = new UnorderedHotelService($this->oPartnerService);
        $this->assertInstanceOf('App\Service\HotelServiceInterface', $oService);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetHotelsForCityExeption()
    {
        $oService = new UnorderedHotelService($this->oPartnerService);
        $oService->getHotelsForCity('test');
    }
    
    public function testGetHotelsForCity()
    {
        $this->oPartnerService
            ->expects($this->atLeastOnce())
            ->method('getResultForCityId')
            ->with(14575);
        
        $oService = new UnorderedHotelService($this->oPartnerService);
        $oService->getHotelsForCity('Düsseldorf');
        $oService->getHotelsForCity('Düsseldorf');
    }
}

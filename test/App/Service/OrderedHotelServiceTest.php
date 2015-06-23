<?php

use App\Service\OrderedHotelService;

class OrderedHotelServiceTest extends \PHPUnit_Framework_TestCase
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
        $oService = new OrderedHotelService($this->oPartnerService);
        $this->assertInstanceOf('App\Service\HotelServiceInterface', $oService);
    }
    
    /**
     * @expectedException \ErrorException
     */
    public function testGetHotelsForCityWithoutDataSorter()
    {
        $oService = new OrderedHotelService($this->oPartnerService);   
        $oService->getHotelsForCity('Düsseldorf');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetHotelsForCityExeption()
    {
        $oMockSorter = $this->getMock('App\Service\DataSorter\DataSorterInterface');
        
        $oService = new OrderedHotelService($this->oPartnerService);   
        $oService->setDataSorter($oMockSorter);
        $oService->getHotelsForCity('test');
    }
    
    public function testGetHotelsForCity()
    {
        $this->oPartnerService
            ->expects($this->atLeastOnce())
            ->method('getResultForCityId')
            ->with(14575)
            ->will($this->returnValue([]));
        
        $oMockSorter = $this->getMock('App\Service\DataSorter\DataSorterInterface');
        $oMockSorter->expects($this->atLeastOnce())
            ->method('sort')
            ->with([]);
        
        $oService = new OrderedHotelService($this->oPartnerService);
        $oService->setDataSorter($oMockSorter);
        
        $oService->getHotelsForCity('Düsseldorf');
        $oService->getHotelsForCity('Düsseldorf');
    }
}

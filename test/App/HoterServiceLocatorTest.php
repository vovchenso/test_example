<?php

use App\HoterServiceLocator;
use App\Service;

class HoterServiceLocatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HoterServiceLocator 
     */
    private $oLocator;
    
    /**
     * @var Service\PartnerService 
     */
    private $oPartner;
    
    public function setUp()
    {
        $this->oPartner = new Service\PartnerService(
            new Service\DataProvider\FileDataProvider()
        );
        
        $this->oLocator = new HoterServiceLocator($this->oPartner);
    }
    
    public function testSetService()
    {
        $oUnorderedSdervice = new Service\UnorderedHotelService($this->oPartner);
        
        $oLocator = $this->oLocator->setService('Unordered', $oUnorderedSdervice);
        $this->assertInstanceOf('App\HoterServiceLocator', $oLocator);
        $this->assertEquals($this->oLocator, $oLocator);
        
        $oService = $this->oLocator->getService('Unordered');
        $this->assertInstanceOf('App\Service\UnorderedHotelService', $oService);
        $this->assertEquals($oUnorderedSdervice, $oService);
    }
    
    /**
     * @expectedException \App\Service\Exception\ServiceNotImplementedException
     */
    public function testSetExceptionService()
    {
        $oService = new \stdClass;
        $this->oLocator->setService('Test', $oService);
    }
    
    public function testGetUnorderedService()
    {
        $oUnorderedSdervice = $this->oLocator->getService('Unordered');
        $this->assertInstanceOf('App\Service\UnorderedHotelService', $oUnorderedSdervice);
        $this->assertEquals($oUnorderedSdervice, $oUnorderedSdervice);
    }
    
    /**
     * @expectedException \App\Service\Exception\ServiceWorngNameException
     */
    public function testGetExceptionWorngNameService()
    {
        $this->oLocator->getService('Test');
    }
    
    /**
     * @expectedException \App\Service\Exception\ServiceNotFoundException
     */
    public function testGetExceptionNotFoundService()
    {
        $this->oLocator->getService('TestOrdered');
    }
    
    public function testGetOrderedService()
    {
        $oService = $this->oLocator->getService('PartnerNameOrdered');
        
        $this->assertInstanceOf('App\Service\OrderedHotelService', $oService);
    }
}

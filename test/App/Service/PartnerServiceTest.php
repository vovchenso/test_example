<?php

use App\Service\PartnerService;

class PartnerServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $oProviderMock = $this->getMock('App\Service\DataProvider\FileDataProvider');
        $oService = new PartnerService($oProviderMock);
        
        $this->assertInstanceOf('App\Service\PartnerServiceInterface', $oService);
    }
    
    public function testGetResultForCityId()
    {
        $aResult = [
            '123' => 'test'
        ];
        $oProviderMock = $this->getMock('App\Service\DataProvider\FileDataProvider', ['load']);
        
        $oProviderMock->expects($this->once())
            ->method('load')
            ->will($this->returnValue($aResult));
        
        $oService = new PartnerService($oProviderMock);
        $sResult = $oService->getResultForCityId(123);
        
        $this->assertEquals($aResult['123'], $sResult);
    }
    
    public function testLoadCalledOnce()
    {
        $aResult = [
            '123' => 'test'
        ];
        $oProviderMock = $this->getMock('App\Service\DataProvider\FileDataProvider', ['load']);
        
        $oProviderMock->expects($this->once())
            ->method('load')
            ->will($this->returnValue($aResult));
        
        $oService = new PartnerService($oProviderMock);
        $oService->getResultForCityId(123);
        $oService->getResultForCityId(123);
        $oService->getResultForCityId(123);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetResultForCityIdException()
    {
        $oProviderMock = $this->getMock('App\Service\DataProvider\FileDataProvider', ['load']);
        
        $oProviderMock->expects($this->once())
            ->method('load')
            ->will($this->returnValue([]));
        
        $oService = new PartnerService($oProviderMock);
        $oService->getResultForCityId(123);
    }
}

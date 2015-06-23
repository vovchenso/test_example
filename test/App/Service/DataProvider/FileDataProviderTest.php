<?php

use App\Service\DataProvider\FileDataProvider;
use App\Service\DataParser\JsonDataParser;

/**
 * @todo: use vfsStream
 */
class FileDataProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testCommon()
    {
        $oProvider = new FileDataProvider();
        $this->assertInstanceOf('App\Service\DataProvider\DataProviderInterface', $oProvider);
    }
    
    public function testSetPath()
    {
        $oProvider = new FileDataProvider();
        $oResult = $oProvider->setPath(TEST_PATH . '/data/test.json');
        
        $this->assertInstanceOf('App\Service\DataProvider\FileDataProvider', $oResult);
        $this->assertEquals($oResult, $oProvider);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetPathException()
    {
        $oProvider = new FileDataProvider();
        $oProvider->setPath('test.json');
    }
    
    public function testConstructirWithPath()
    {
        $oMock = $this->getMockBuilder('App\Service\DataProvider\FileDataProvider')
            ->setMethods(['setPath'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $oMock->expects($this->once())
            ->method('setPath')
            ->with('test.json');
        
        $oMock->__construct('test.json');
    }
    
    public function testSetParser()
    {
        $oParser = new JsonDataParser();
        $oProvider = new FileDataProvider();
        $oResult = $oProvider->setParser($oParser);
        
        $this->assertInstanceOf('App\Service\DataProvider\FileDataProvider', $oResult);
        $this->assertEquals($oResult, $oProvider);
    }
    
    /**
     * @expectedException \ErrorException
     */
    public function testLoadExeption()
    {
        $oProvider = new FileDataProvider();
        $oProvider->load();
    }
    
    public function testLoad()
    {
        $oParserMock = $this->getMock('App\Service\DataParser\JsonDataParser', ['parse']);
        
        $oProvider = new FileDataProvider(TEST_PATH . '/data/test.json');
        $oProvider->setParser($oParserMock);
        
        $oParserMock->expects($this->once())
            ->method('parse');
        
        $oProvider->load();
    }
}

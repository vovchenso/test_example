<?php

use App\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testCommon()
    {
        $oContainer = new Container();
        
        $this->assertInstanceOf('App\ContainerInterface', $oContainer);
    }
    
    public function testSetGet()
    {
        $oContainer = new Container();
        
        $aData = array(1, 2, 3);
        $oContainer->set('test', $aData);
        
        $this->assertInternalType('array', $oContainer->get('test'));
        $this->assertEquals($aData, $oContainer->get('test'));
    }
    
    /**
     * @expectedException \App\Service\Exception\ServiceNotFoundException
     */
    public function testNoDefinedService()
    {
        $oContainer = new Container();
        $oContainer->get('test');
    }
    
    /**
     * @expectedException \App\Service\Exception\ServiceNotFoundException
     */
    public function testUnsetService()
    {
        $oContainer = new Container();
        $oContainer->set('test', 1);
        $this->assertEquals(1, $oContainer->get('test'));
        
        $oContainer->set('test', null);
        $oContainer->get('test');
    }
    
    public function testHas()
    {
        $oContainer = new Container();
        $oContainer->set('test', 1);
        
        $this->assertTrue($oContainer->has('test'));
        $this->assertFalse($oContainer->has('no-test'));
        
        $oContainer->set('test', null);
        $this->assertFalse($oContainer->has('test'));
    }
}

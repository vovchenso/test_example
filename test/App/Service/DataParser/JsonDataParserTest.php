<?php

use App\Service\DataParser\JsonDataParser;
use App\Service\DataParser\Validator\ValidatorInterface;

class TrueValidator implements ValidatorInterface
{
    public function validate($value) 
    {
        return true;
    }
}

class FalseValidator implements ValidatorInterface
{
    public function validate($value) 
    {
        return false;
    }
}

class JsonDataParserTest extends \PHPUnit_Framework_TestCase
{
    public function testCommon()
    {
        $oParser = new JsonDataParser();
        
        $this->assertInstanceOf('App\Service\DataParser\DataParserInterface', $oParser);
        $this->assertInstanceOf('App\Service\DataParser\DataParserAbstract', $oParser);
    }
    
    public function testValidator()
    {
        $oParser = new JsonDataParser();
        $oParser->setValidator('test_true', new TrueValidator);
        $oParser->setValidator('test_false', new FalseValidator);
        
        $this->assertTrue($oParser->isValid('test_true', ''));        
        $this->assertFalse($oParser->isValid('test_false', ''));
    }
    
    /**
     * @expectedException \ErrorException
     */
    public function testParseInvalidJson()
    {
        $sJson = 'test';
        
        $oParser = new JsonDataParser();
        $oParser->parse($sJson);
    }
    
    public function testParseEmpty()
    {
        $sJson = '';
        
        $oParser = new JsonDataParser();
        $aResult = $oParser->parse($sJson);
        
        $this->assertInternalType('array',$aResult);
        $this->assertEmpty($aResult);
    }
    
    public function testParse()
    {
        $sJson = file_get_contents(TEST_PATH . '/data/test.json');
        $aJson = json_decode($sJson, true);
        $aJson = $aJson['hotels'];
        
        $oParser = new JsonDataParser();
        $aResult = $oParser->parse($sJson);
        
        $this->assertInternalType('array',$aResult);
        $this->assertCount(2, $aResult);
        
        foreach ($aResult as $iHotelId => $oHotel) {
            $aHotel = $aJson[$iHotelId];
            
            $this->assertInstanceOf('App\Entity\Hotel', $oHotel);
            $this->assertEquals($aHotel['name'], $oHotel->sName);
            $this->assertEquals($aHotel['adr'], $oHotel->sAdr);
            
            foreach ($oHotel->aPartners as $iPartnerId => $oPartner) {
                $aPartner = $aHotel['partners'][$iPartnerId];
                
                $this->assertInstanceOf('App\Entity\Partner', $oPartner);
                $this->assertEquals($aPartner['name'], $oPartner->sName);
                $this->assertEquals($aPartner['url'], $oPartner->sHomepage);
                
                foreach ($oPartner->aPrices as $iPriceId => $oPrice) {
                    $aPrice = $aPartner['prices'][$iPriceId];
                    
                    $this->assertInstanceOf('App\Entity\Price', $oPrice);
                    $this->assertEquals($aPrice['description'], $oPrice->sDescription);
                    $this->assertEquals($aPrice['amount'], $oPrice->fAmount);
                    $this->assertInstanceOf('DateTime', $oPrice->oFromDate);
                    $this->assertEquals($aPrice['from'], $oPrice->oFromDate->format('Y-m-d'));
                    $this->assertInstanceOf('DateTime', $oPrice->oToDate);
                    $this->assertEquals($aPrice['to'], $oPrice->oToDate->format('Y-m-d'));
                }
            }
        }
    }
    
    public function testParseValidateUrlCalled()
    {
        $sJson = file_get_contents(TEST_PATH . '/data/test.json');
        
        $oMockValidator = $this->getMock('App\Service\DataParser\Validator\UrlValidator');
        
        $oParser = new JsonDataParser();        
        $oParser->setValidator('url', $oMockValidator);
        
        $oMockValidator->expects($this->atLeastOnce())
            ->method('validate')
            ->will($this->returnValue('true'));
        
        $oParser->parse($sJson);
    }
}

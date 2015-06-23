<?php

use App\Service\DataParser\Validator\UrlValidator;

class UrlValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $aValidCases = [
        'http://www.test.com',
        'http://test.com',
        'https://www.test.com',
        'https://test.com',
        'http://test.org',
        'http://test.ua'
    ];
    
    private $aInvalidCases = [
        'ftp://test.com',
        'http://test.com/test',
        'http://www.test.localhost',
        'http://test.t',
        'http://test',
        'test string',
        'test',
        'test.com',
        ''
    ];
    
    public function testCommon()
    {
        $oValidator = new UrlValidator();
        
        $this->assertInstanceOf('App\Service\DataParser\Validator\ValidatorInterface', $oValidator);
    }
    
    public function testValid()
    {
        $oValidator = new UrlValidator();
        
        foreach ($this->aValidCases as $sTest) {
            $this->assertTrue($oValidator->validate($sTest));
        }
    }
    
    public function testInvalid()
    {
        $oValidator = new UrlValidator();
        
        foreach ($this->aInvalidCases as $sTest) {
            $this->assertFalse($oValidator->validate($sTest));
        }
    }
}

<?php

namespace App\Service\DataParser;

use App\Service\DataParser\Validator\ValidatorInterface;

/**
 * @author Vladimir Maliuchenko
 */
abstract class DataParserAbstract
{        
    protected $aValidators = array();
    
    /**
     * Set field validator
     * 
     * @param string $sField
     * @param \App\Service\DataParser\Validator\ValidatorInterface $oValidator
     * @return \App\Service\DataParser\DataParserAbstract
     */
    public function setValidator($sField, ValidatorInterface $oValidator)
    {
        $this->aValidators[$sField] = $oValidator;
        return $this;
    }
    
    /**
     * Check if given value is valid by setted validators
     * 
     * @param string $sField
     * @param mixed $sValue
     * @return boolean
     */
    public function isValid($sField, $sValue)
    {
        if (array_key_exists($sField, $this->aValidators)) {
            return $this->aValidators[$sField]->validate($sValue);
        }
        
        return true;
    }
}

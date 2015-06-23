<?php

namespace App\Service\DataParser;

use App\Entity;

/**
 * @author Vladimir Maliuchenko
 */
class JsonDataParser extends DataParserAbstract implements DataParserInterface
{        
    /**
     * @param mixed $mData Data to parse
     *
     * @return \App\Entity\Hotel[]
     * @throws \ErrorException data is invalid.
     */
    public function parse($mData)
    {
        $aData = json_decode($mData, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \ErrorException('Invalid JSON data given');
        }
        
        return $aData ? $this->process($aData['hotels']) : array();
    }
    
    /**
     * Convert given array to 
     * 
     * @param array $aData
     * @return \App\Entity\Hotel[]
     */
    private function process(array $aData)
    {
        $this->validateData($aData);
        
        $aResult = array();
        
        foreach ($aData as $iId => $aHotel)
        {
            $oHotel = new Entity\Hotel();
            $oHotel->sName = $aHotel['name'];
            $oHotel->sAdr = $aHotel['adr'];
            $oHotel->aPartners = $this->processPartners($aHotel['partners']);
            
            $aResult[$iId] = $oHotel;
        }
        
        return $aResult;
    }
    
    /**
     * Process Hotel's partners
     * 
     * @param array $aData
     * @return \App\Entity\Partner[]
     */
    private function processPartners(array $aData)
    {
        $aResult = array();
        
        foreach ($aData as $iId => $aPartner)
        {
            $oPartner = new Entity\Partner();
            $oPartner->sName = $aPartner['name'];
            $oPartner->sHomepage = $aPartner['url'];
            $oPartner->aPrices = $this->processPrices($aPartner['prices']);
            
            $aResult[$iId] = $oPartner;
        }
        
        return $aResult;
    }
    
    /**
     * Process Partner's prices
     * 
     * @param array $aData
     * @return \App\Entity\Price[]
     */
    private function processPrices(array $aData)
    {
        $aResult = array();
        
        foreach ($aData as $iId => $aPrice)
        {
            $oPrice = new Entity\Price();
            $oPrice->sDescription = $aPrice['description'];
            $oPrice->fAmount = $aPrice['amount'];
            $oPrice->oFromDate = new \DateTime($aPrice['from']);
            $oPrice->oToDate = new \DateTime($aPrice['to']);
            
            $aResult[$iId] = $oPrice;
        }
        
        return $aResult;
    }
    
    /**
     * Recursive function to validate data by given validators
     * 
     * @param array $aData
     * @throws \Exception
     */
    private function validateData(array $aData)
    {
        foreach ($aData as $sField => $sValue)
        {
            if (is_array($sValue)) {
                $this->validateData($sValue);
            }
            
            if (!$this->isValid($sField, $sValue))
            {
                throw new \Exception(
                    sprintf('Field [%s] contains invalid value "%s"', $sField, $sValue)
                );
            }
        }
    }
}

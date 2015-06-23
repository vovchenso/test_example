<?php

namespace App\Service;

/**
 * This class is an (unfinished) example implementation of an ordered hotel service.
 *
 * @author Vladimir Maliuchenko
 */
class OrderedHotelService extends UnorderedHotelService
{
    /**
     * @var DataSorter\DataSorterInterface 
     */
    private $oDataSorter = null;
    
    /**
     * Set sorter object
     * 
     * @param \App\Service\DataSorter\DataSorterInterface $oDataSorter
     * @return \App\Service\OrderedHotelService
     */
    public function setDataSorter(DataSorter\DataSorterInterface $oDataSorter)
    {
        $this->oDataSorter = $oDataSorter;
        return $this;
    }
    
    /**
     * @inherited
     */
    public function getHotelsForCity($sCityName)
    {
        if (null === $this->oDataSorter) {
            throw new \ErrorException('Data Sorter is not set');
        }
        
        $aPartnerResults = parent::getHotelsForCity($sCityName);
        return $this->oDataSorter->sort($aPartnerResults);
    }
}

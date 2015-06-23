<?php

namespace App\Service\DataSorter;

/**
 * Sorts data by price
 * 
 * @author Vladimir Maliuchenko
 */
class PriceDataSorter implements DataSorterInterface
{
    /**
     * @inherited
     */
    public function sort(array $aData)
    {
        foreach ($aData as $oHotel) {
            foreach ($oHotel->aPartners as $oPartner) {
                $this->sortPrices($oPartner->aPrices);
            }
        }
        
        return $aData;
    }
    
    private function sortPrices(array & $aPrices)
    {
        usort($aPrices, function($a, $b) {
            if ($a->fAmount == $b->fAmount) {
                return 0;
            }
            if ($a->fAmount > $b->fAmount) {
                return 1;
            } else {
                return -1;
            }
        });
        
        return $aPrices;
    }
}

<?php

namespace App\Service\DataSorter;

/**
 * Sorts data by partner name field
 * 
 * @author Vladimir Maliuchenko
 */
class PartnerNameDataSorter implements DataSorterInterface
{
    /**
     * @inherited
     */
    public function sort(array $aData)
    {
        foreach ($aData as $oHotel) {
            $this->sortPartners($oHotel->aPartners);
        }
        
        return $aData;
    }
    
    private function sortPartners(array & $aPartners)
    {
        usort($aPartners, function($a, $b) {
            if ($a->sName == $b->sName) {
                return 0;
            }
            if ($a->sName > $b->sName) {
                return 1;
            } else {
                return -1;
            }
        });

        return $aPartners;
    }
}

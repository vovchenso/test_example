<?php

namespace App\Service\DataSorter;

/**
 * @author Vladimir Maluchenko
 */
interface DataSorterInterface
{
    /**
     * @param \TApp\Entity\Hotel[] $aData
     * @return \App\Entity\Hotel[] Sorted data
     */
    public function sort(array $aData);
}

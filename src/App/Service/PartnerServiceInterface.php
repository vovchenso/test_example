<?php

namespace App\Service;

/**
 * Represents the connection to a specific partner. In this test case we will
 * pretend to have only one partner to make it not too complex.
 */
interface PartnerServiceInterface
{
    /**
     * This method should read from a datasource (JSON in our case)
     * and return an unsorted list of hotels found in the datasource.
     * 
     * @param integer $iCityId
     *
     * @return \App\Entity\Hotel[]
     */
    public function getResultForCityId($iCityId);
}

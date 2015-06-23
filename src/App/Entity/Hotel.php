<?php

namespace App\Entity;

/**
 * Represents a single hotel in the result.
 */
class Hotel 
{
    /**
     * Name of the hotel.
     *
     * @var string
     */
    public $sName;

    /**
     * Street adr. of the hotel.
     * 
     * @var string
     */
    public $sAdr;

    /**
     * Unsorted list of partners with their corresponding prices.
     * 
     * @var Partner[]
     */
    public $aPartners = array();
}

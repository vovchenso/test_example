<?php

namespace App\Entity;

/**
 * Represents a single partner from a search result.
 */
class Partner
{
    /**
     * Name of the partner
     * @var string
     */
    public $sName;

    /**
     * Url of the partner's homepage (root link)
     * 
     * @var string
     */
    public $sHomepage;

    /**
     * Unsorted list of prices received from the 
     * actual search query.
     * 
     * @var Price[]
     */
    public $aPrices = array();
}

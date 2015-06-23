<?php

namespace App\Service;

/**
 * The implementation is responsible for resolving the id of the city from the
 * given city name (in this simple case via an array of CityName => id). The second 
 * responsibility is to sort the returning result from the partner service in whatever
 * way. 
 * 
 */
interface HotelServiceInterface
{
    /**
     * @param string $sCityName Name of the city to search for.
     *
     * @return \App\Entity\Hotel[]
     * @throws \InvalidArgumentException if city name is unknown.
     */
    public function getHotelsForCity($sCityName);
}

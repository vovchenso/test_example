<?php

namespace App\Service\DataProvider;

/**
 * @author Vladimir Maliuchenko
 */
interface DataProviderInterface
{
    /**
     * @return \App\Entity\Hotel[]
     * @throws \InvalidArgumentException if city name is unknown.
     */
    public function load();
}

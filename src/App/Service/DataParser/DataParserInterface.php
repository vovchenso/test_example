<?php

namespace App\Service\DataParser;

/**
 * @author Vladimir Maliuchenko
 */
interface DataParserInterface
{
    /**
     * @param mixed $mData Data to parse
     *
     * @return \App\Entity\Hotel[]
     * @throws \InvalidArgumentException data is invalid.
     */
    public function parse($mData);
}

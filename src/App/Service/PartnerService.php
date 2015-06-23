<?php

namespace App\Service;

/**
 * This class is an example implementation of an partner service.
 *
 * @author Vladimir Maliuchenko
 */
class PartnerService implements PartnerServiceInterface
{
    private $aData = null;
    
    private $oProvider = null;
    
    /**
     * Constructor. Inject data provider
     * 
     * @param \App\Service\DataProvider\DataProviderInterface $provider
     */
    public function __construct(DataProvider\DataProviderInterface $provider)
    {
        $this->oProvider = $provider;
    }

    /**
     * @inherited
     */
    public function getResultForCityId($iCityId)
    {
        if (null === $this->aData) {
            $this->aData = $this->oProvider->load();
        }
        
        if (!isset($this->aData[$iCityId]))
        {
            throw new \InvalidArgumentException(
                sprintf('Given city id [%d] is not mapped.', $iCityId)
            );
        }
        
        return $this->aData[$iCityId];
    }
}

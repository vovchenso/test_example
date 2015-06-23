<?php

namespace App;

use App\Service\Exception;

/**
 * Description of ServiceLocator
 *
 * @author Vladimir Maluchenko
 */
class HoterServiceLocator
{
    /**
     * @var Container
     */
    private $oContainer = null;
    
    /**
     * @var Service\PartnerServiceInterface
     */
    private $oPartnerService = null;
    
    /**
     * HoterServiceLocator constructor. Inject instance of partner service to load hotel services
     * 
     * @param \App\Service\PartnerServiceInterface $oPartnerService
     */
    public function __construct(Service\PartnerServiceInterface $oPartnerService)
    {
        $this->oPartnerService = $oPartnerService;
        $this->oContainer = new Container();
    }
    
    /**
     * Gets Service from container
     * 
     * @param string $sName
     * @return Service\HotelServiceInterface
     */
    public function getService($sName)
    {
        // first check if service already exists
        if ($this->oContainer->has($sName)) {
            return $this->oContainer->get($sName);
        }
        
        // try to load unexisten service
        $oService = $this->loadService($sName);
        return $oService;
    }

    /**
     * Set a service to container
     * 
     * @param string $sName
     * @param object $oService
     * @return \App\HoterServiceLocator
     * @throws Exception\ServiceNotImplementedException
     */
    public function setService($sName, $oService)
    {
        if (!$oService instanceof Service\HotelServiceInterface)
        {
            throw new Exception\ServiceNotImplementedException($sName);
        }
        
        $this->oContainer->set($sName, $oService);
        return $this;
    }
    
    /**
     * Lazy load of Service
     * 
     * @param string $sName
     * @return Service\HotelServiceInterface
     * @throws Exception\ServiceWorngNameException
     * @throws Exception\ServiceWorngNameException
     */
    private function loadService($sName)
    {
        if ('Unordered' === $sName) 
        {
            return new Service\UnorderedHotelService($this->oPartnerService);
        }
        
        if (!preg_match('/^([a-zA-Z]+)Ordered$/', $sName, $aMatches))
        {
            throw new Exception\ServiceWorngNameException($sName);
        }
        
        $sOrder = $aMatches[1];
        
        if (!$this->checkOrder($sOrder)) 
        {
            throw new Exception\ServiceNotFoundException($sName);
        }
        
        return $this->getOrderedService($sOrder);
    }
    
    /**
     * Return instance of OrderedHotelService with setted data sorter
     * 
     * @param string $sOrder
     * @return \App\Service\OrderedHotelService
     */
    private function getOrderedService($sOrder)
    {
        $sSorterClass = __NAMESPACE__ . '\\Service\\DataSorter\\' . $sOrder . 'DataSorter';
        
        $oDataSorter = new $sSorterClass;
        
        $oService = new Service\OrderedHotelService($this->oPartnerService);
        $oService->setDataSorter($oDataSorter);
        
        return $oService;
    }
    
    /**
     * Check if given sort service exists
     * 
     * @param string $sName
     * @return boolean
     */
    private function checkOrder($sName)
    {
        $sFileName = sprintf(
            '%s/Service/DataSorter/%sDataSorter.php',
            __DIR__,
            $sName
        );
                
        return file_exists($sFileName);
    }
}

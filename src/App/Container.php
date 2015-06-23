<?php

namespace App;

use App\Service\Exception\ServiceNotFoundException;

class Container implements ContainerInterface
{
    private $aServices = array();
    
    /**
     * @inherit
     */
    public function set($id, $service)
    {
        $this->aServices[$id] = $service;

        if (null === $service) {
            unset($this->aServices[$id]);
        }
    }

    /**
     * @inherit
     */
    public function has($id)
    {
        return isset($this->aServices[$id])
            || array_key_exists($id, $this->aServices);
    }

    /**
     * @inherit
     */
    public function get($id)
    {
        if ($this->has($id)) {
            return $this->aServices[$id];            
        }
        
        throw new ServiceNotFoundException($id);
    }
}

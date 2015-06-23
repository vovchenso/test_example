<?php

namespace App;

interface ContainerInterface
{
    /**
     * Sets a service
     *
     * @param string $id The service identifier
     * @param object $service The service instance
     */
    public function set($id, $service);

    /**
     * Gets a service

     * @param string $id The service identifier
     * @return object The associated service
     * @throws ServiceNotFoundException When the service is not defined
     */
    public function get($id);

    /**
     * Returns true if the given service is defined.
     *
     * @param string $id The service identifier
     * @return Boolean true if the service is defined, false otherwise
     */
    public function has($id);
}


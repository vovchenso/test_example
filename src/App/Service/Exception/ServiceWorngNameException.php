<?php

namespace App\Service\Exception;

/**
 * This exception is thrown when a wrong name of service is requested.
 */
class ServiceWorngNameException extends \InvalidArgumentException
{
    public function __construct($service, $code = 0, $previous = null) 
    {
        $msg = sprintf('Wrong Service name given [%s]', $service);
        parent::__construct($msg, $code, $previous);
    }
}


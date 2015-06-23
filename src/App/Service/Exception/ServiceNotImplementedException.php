<?php

namespace App\Service\Exception;

/**
 * This exception is thrown when a non-existent service is requested.
 */
class ServiceNotImplementedException extends \InvalidArgumentException
{
    public function __construct($service, $code = 0, $previous = null) 
    {
        $msg = sprintf('Service [%s] does not implemented interface', $service);
        parent::__construct($msg, $code, $previous);
    }
}


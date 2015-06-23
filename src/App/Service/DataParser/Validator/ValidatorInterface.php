<?php

namespace App\Service\DataParser\Validator;

/**
 * Description of ValidatorInterface
 *
 * @author Vladimir Maliuchenko
 */
interface ValidatorInterface
{
    /**
     * Validate given value
     * 
     * @param mixed $value
     * @return bool TRUE if value is valid, FALSE otherwise
     */
    public function validate($value);
}

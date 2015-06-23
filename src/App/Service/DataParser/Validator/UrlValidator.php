<?php

namespace App\Service\DataParser\Validator;

/**
 * Validate given value to be valid URL
 *
 * @author Vladimir Maliuchenko
 */
class UrlValidator implements ValidatorInterface
{
    public function validate($value)
    {
        return (bool) preg_match('/^http[s]?\:\/\/[\da-z\.-]+\.[a-z\.]{2,6}$/', $value);
    }
}

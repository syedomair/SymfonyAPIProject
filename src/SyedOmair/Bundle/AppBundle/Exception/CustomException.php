<?php

namespace SyedOmair\Bundle\AppBundle\Exception;

class CustomException extends \Exception
{
    protected $errorMessage;

    public function getErrorMessage() {
        return $this->errorMessage;
    }
}

<?php
namespace SyedOmair\Bundle\AppBundle\Services;

use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Exception;
use SyedOmair\Bundle\AppBundle\Exception\CustomException;

class ErrorService
{
    protected function throwException($error_code, $error_msg)
    {
        $errorObject = array(
            'code' => $error_code,
            'error_message' => $error_msg
        );

        $errorArray = array(
            'status' => $error_code,
            'data' => $errorObject,
        );
        
        throw new Exception(json_encode($errorArray) ,Codes::HTTP_BAD_REQUEST, NULL);
    }

    public function handleException(CustomException $exception, $fields = array()) {
        $this->throwException($exception->getCode(), $exception->geterrorMessage());
    }
}

<?php
namespace SyedOmair\Bundle\AppBundle\Services;

use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class ErrorService
{
    const ERROR_INVALID_PARAMETER = 'Invalid parameter';
    const ERROR_INVALID = 'Invalid ';

    protected function throwException($error_code, $user_msg, $developer_msg, $fields)
    {
        $errorObject = array(
            'code' => $error_code,
            'user_message' => $user_msg,
            'developer_message' => $developer_msg,
            'fields' => $fields,
        );

        $errorArray = array(
            'outcome' => 'error',
            'data' => $errorObject,
            'status' => $error_code
        );
        
        throw new Exception(json_encode($errorArray) ,Codes::HTTP_BAD_REQUEST, NULL);
    }

}

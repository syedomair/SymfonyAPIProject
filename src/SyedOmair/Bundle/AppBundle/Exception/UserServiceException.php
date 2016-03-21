<?php
namespace SyedOmair\Bundle\AppBundle\Exception;

class UserServiceException  extends CustomException
{
    protected $errorMessage = "";
    protected $code = 0;

    public function createUserAlreadyExists()
    {
        $this->errorMessage = 'User already exists';
        $this->code = 30001;
        return $this;
    }
}

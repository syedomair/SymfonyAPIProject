<?php
namespace SyedOmair\Bundle\AppBundle\Exception;

class ProductServiceException  extends CustomException
{
    protected $errorMessage = "";
    protected $code = 0;

    public function getProductsInvalidParameterId()
    {
        $this->errorMessage = 'Parameter missing: id ';
        $this->code = 20001;
        return $this;
    }
}

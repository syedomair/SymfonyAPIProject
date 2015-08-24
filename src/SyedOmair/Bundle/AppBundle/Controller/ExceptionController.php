<?php
namespace SyedOmair\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController  extends ContainerAware
{
    public function showAction(Request $request, $exception, DebugLoggerInterface $logger = null) 
    {
        $view = new View();
        if($this->isJson($exception->getMessage()))
        {
            $tempArray = json_decode($exception->getMessage(), true);
            $view->setData($tempArray);
        }
        else
        {
            $view->setData($exception->getMessage());
        }
        $view->setFormat('json');
        return $this->container->get('fos_rest.view_handler')->handle($view);
    }

    function isJson($string) 
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

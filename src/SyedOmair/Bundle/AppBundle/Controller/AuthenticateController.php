<?php
namespace SyedOmair\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AuthenticateController  extends SOFOSRestController
{
    /**
     * @Route("/authenticate")
     * @Method("GET")
     */
    public function getAuthenticateAction(Request $request) 
    {
        $token = $request->headers->get('custom-auth');
        return $this->handleView($this->createView($this->get('user_service')->authenticate($token)));
    }

}

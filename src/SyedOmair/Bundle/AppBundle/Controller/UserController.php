<?php
namespace SyedOmair\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use CrowdValley\Bundle\CoreBundle\Controller\CVFOSRestController;

class UserController  extends CVFOSRestController
{
    /**
     *  Get Users 
     *             
     * @QueryParam(name="page", requirements="\d+", default="0", description="record offset.")
     * @QueryParam(name="limit", requirements="\d+", default="100", description="number of records.")
     * @QueryParam(name="orderby", requirements="[a-z]+", allowBlank=true, default="name", description="OrderBy field")
     * @QueryParam(name="sort", requirements="(asc|desc)+", allowBlank=true, default="asc", description="Sorting order")
     *             
     * @Route("/users")
     * @Method("GET")
     */
    public function getUsersAction($network, ParamFetcher $paramFetcher) 
    {
        $page = $paramFetcher->get('page');
        $limit = $paramFetcher->get('limit');
        $orderby = $paramFetcher->get('orderby');
        $sort = $paramFetcher->get('sort');
        return $this->handleView(array('test'));//$this->createView($this->get('cv_user')->getUsersForNetwork($network, $page, $limit, $orderby, $sort)));
    }

    /**
     * Register a new User
     *
     * @Route("/users")
     * @Method("POST")
     */
    public function postUserAction(Request $request, $network) 
    {
        $parameters = json_decode($request->getContent(), true);
        return $this->handleView(array('test'));//$this->createView($this->get('cv_user')->create($parameters, $network, $request->getRequestUri())));
    }

}

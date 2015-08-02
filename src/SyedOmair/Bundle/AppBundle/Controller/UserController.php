<?php
namespace SyedOmair\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class UserController  extends FOSRestController
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
    public function getUsersAction(ParamFetcher $paramFetcher) 
    {
        $page = $paramFetcher->get('page');
        $limit = $paramFetcher->get('limit');
        $orderby = $paramFetcher->get('orderby');
        $sort = $paramFetcher->get('sort');

        $view = new View();
        $view->setData('GET test');
        $view->setStatusCode(200);
        $view->setFormat('json');



        return $this->handleView($view);//$this->createView($this->get('cv_user')->getUsersForNetwork($network, $page, $limit, $orderby, $sort)));
    }

    /**
     * Register a new User
     *
     * @Route("/users")
     * @Method("POST")
     */
    public function postUserAction(Request $request) 
    {
        $parameters = json_decode($request->getContent(), true);

        $view = new View();
        $view->setData('POST test');
        $view->setStatusCode(200);
        $view->setFormat('json');

        return $this->handleView($view);//$this->createView($this->get('cv_user')->create($parameters, $network, $request->getRequestUri())));
    }

}

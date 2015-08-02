<?php

namespace CrowdValley\Bundle\CoreBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;
use CrowdValley\Bundle\CoreBundle\Tests\Fixtures\Entity\LoadPlanData;


class UserControllerTest extends WebTestCase
{

    public function setUp()
    {
        $this->auth = array(
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW'   => 'userpass',
        );
        $this->client = static::createClient(array(), $this->auth);
    }

    public function testGetAction()
    {

        $route =  $this->getUrl('crowdvalley_api_user_postuser'));
        $requestPostArray = array('test');
        $requestPostArray = json_encode($requestPostArray);
        $this->client->request('POST', $route, array(), array(), array('CONTENT_TYPE' => 'application/json'),$requestPostArray);
 
        $response = $this->client->getResponse();
        var_dump($response->getContent());
        $this->assertEquals( $response->getStatusCode(), 200);

    }
}

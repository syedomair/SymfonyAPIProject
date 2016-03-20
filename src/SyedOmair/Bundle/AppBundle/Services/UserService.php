<?php
namespace SyedOmair\Bundle\AppBundle\Services;

use SyedOmair\Bundle\AppBundle\Entity\User;

class UserService extends BaseService
{

    public function __construct($container, $entityManager, $errorService)
    {
        parent::__construct($entityManager, $errorService);
    }

    public function getAUser($id)
    {
        $user =  $this->entityManager->getRepository('AppBundle:User')->findOneById($id);

        $dataArray = array('user' => $this->responseArray($user));
        return $this->successResponse($dataArray);
    }

    public function create($parameters)
    {
        $user = new User();
        $user->setEmail($parameters['email']);
        $user->setGivenName($parameters['first_name']);
        $user->setFamilyName($parameters['last_name']);
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        $this->passwordEncryption($parameters['password'], $user);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $dataArray = array('user_id' => $user->getId());
        return $this->successResponse($dataArray);
    }
    private function passwordEncryption($password, $user){
        $salt = $this->generateUserSalt();
        $user->setPassword(crypt($password,$salt));
        $user->setSalt($salt);
    }
    private function generateUserSalt(){
        return base_convert(uniqid(mt_rand(), true), 16, 36);
    }
    private function responseArray($user)
    {
        $responseArray = array(
            'id' => $user->getId(),
            'first_name' => $user->getGivenName(),
            'last_name' => $user->getFamilyName()
        );
    return $responseArray;
    }

    public function authenticate($token)
    {
        $rtnArray =  array('token' => $token);
        return $this->successResponse($rtnArray);
    }
}

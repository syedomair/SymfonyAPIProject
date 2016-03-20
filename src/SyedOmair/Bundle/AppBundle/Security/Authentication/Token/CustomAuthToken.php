<?php
namespace SyedOmair\Bundle\AppBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class CustomAuthToken extends AbstractToken
{
    public $created;
    public $digest;
    public $nonce;
    public $encryptedPass;
    public $network;
    public $networkId;
    public $apiKey;
    public $accessLevel;

    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(1);
    }

    public function getCredentials()
    {
        return '';
    }
}

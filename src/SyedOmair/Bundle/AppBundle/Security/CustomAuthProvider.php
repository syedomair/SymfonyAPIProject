<?php
namespace SyedOmair\Bundle\AppBundle\Security;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use SyedOmair\Bundle\AppBundle\Security\CustomAuthToken;
use Symfony\Component\Security\Core\Util\StringUtils;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthProvider implements AuthenticationProviderInterface
{
    private $userProvider;
    private $cacheDir;

    public function __construct(UserProviderInterface $userProvider, $cacheDir)
    {
        $this->userProvider = $userProvider;
        $this->cacheDir     = $cacheDir;
    }

    public function authenticate(TokenInterface $token)
    {
            if($token->getUsername() == 'new_user_registration')
                return $token;
            else
            {
                $this->user = $this->userProvider->loadUserByUsername(array($token->getUsername()));

                if($this->user ) 
                {
                    $plainUserPassword = base64_decode($token->encryptedPass);
                    if($this->_hash_equals(crypt($plainUserPassword, $this->user->getSalt()), $this->user->getPassword())) 
                    {
                        $authenticatedToken = new CustomAuthToken($this->user->getRoles());
                        $authenticatedToken->setUser($this->user);
                        return $authenticatedToken;
                    }
                }

            }
        throw new AuthenticationException('Authentication failed.');
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof CustomAuthToken;
    }

    private function _hash_equals($str1, $str2) 
    {
        if(strlen($str1) != strlen($str2)) 
        {
            return false;
        } 
        else 
        {
          $res = $str1 ^ $str2;
          $ret = 0;
          for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
          return !$ret;
        }
    }

}

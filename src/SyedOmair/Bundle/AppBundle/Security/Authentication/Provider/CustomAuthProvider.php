<?php
namespace SyedOmair\Bundle\AppBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use SyedOmair\Bundle\AppBundle\Security\Authentication\Token\CustomAuthToken;
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
            if($token->getUsername() == 'new')
                return $token;
            else{
                $this->user = $this->userProvider->loadUserByUsername(array($token->getUsername(), $token->networkId));

                if ($this->user ) {
                    //$encrypt = new Encrypt();
                    //$plainPassword = $encrypt->decrypt(base64_decode($token->encryptedPass), $token->apiSecret);
                    // TODO: Remove 3-rd parameter from isPasswordValid
                    //$passwordValid = $this->container->get('PBKDF2_encoder')->isPasswordValid($this->user->getPassword(), $plainPassword, $this->user->getSalt(), $this->user);
                    //if ($passwordValid) {
                        $authenticatedToken = new CustomAuthToken($this->user->getRoles());
                        $authenticatedToken->setUser($this->user);
                        return $authenticatedToken;
//                    }
                }

            }
        throw new AuthenticationException('Authentication failed.');
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof CustomAuthToken;
    }
}

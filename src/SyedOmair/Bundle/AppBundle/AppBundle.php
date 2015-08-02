<?php

namespace SyedOmair\Bundle\AppBundle;

use CrowdValley\Bundle\ApiBundle\DependencyInjection\Security\Factory\CVAuthFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppBundle extends Bundle
{
/*
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new CVAuthFactory());
    }
*/
}

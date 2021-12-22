<?php

namespace Vinecave\Bundle\RegistryBundle;

use Vinecave\Bundle\RegistryBundle\DependencyInjection\RegistryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class VinecaveRegistryBundle  extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegistryCompilerPass());
    }
}

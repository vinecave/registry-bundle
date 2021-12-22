<?php

namespace Vinecave\Bundle;

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

<?php

namespace Vinecave\Bundle\RegistryBundle\DependencyInjection;

use Vinecave\Bundle\RegistryBundle\Registry\Registry;
use Vinecave\Bundle\CollectionBundle\Container\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class VinecaveRegistryExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->registerForAutoconfiguration(Registry::class)
            ->addTag(Registry::class);
    }
}

<?php

namespace Vinecave\Bundle\RegistryBundle\DependencyInjection;

use Vinecave\Bundle\RegistryBundle\Registry\Registry;
use Vinecave\Bundle\CollectionBundle\Container\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class VinecaveRegistryExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->registerForAutoconfiguration(Registry::class)
            ->addTag(Registry::class);

        $this->loadExtension($container, __DIR__);
    }
}

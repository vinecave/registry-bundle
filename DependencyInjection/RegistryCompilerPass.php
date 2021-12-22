<?php

namespace Vinecave\Bundle\RegistryBundle\DependencyInjection;

use Vinecave\Bundle\RegistryBundle\Registry\Registry;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegistryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds(Registry::class);
        $declaredClasses = get_declared_classes();

        foreach ($taggedServices as $serviceId => $tags) {
            $poolDef = $container->getDefinition($serviceId);

            $poolClass = $poolDef->getClass();

            $providerClassOrInterface = call_user_func([$poolClass, 'getProviderClass']);

            foreach ($declaredClasses as $class) {
                if (false === is_subclass_of($class, $providerClassOrInterface, true)) {
                    continue;
                }

                $reflection = new ReflectionClass($class);

                if ($reflection->isAbstract()) {
                    continue;
                }

                $provider = $container->getDefinition($class);

                $poolDef->addMethodCall(
                    'addProvider',
                    [
                        $provider
                    ]
                );
            }
        }
    }
}

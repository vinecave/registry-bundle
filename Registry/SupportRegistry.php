<?php

namespace Vinecave\Bundle\RegistryBundle\Registry;

use Vinecave\Bundle\CollectionBundle\Behavior\SupportInterface;

abstract class SupportRegistry extends Registry
{
    public function addProvider($provider)
    {
        $this->validateProvider($provider);

        if ($provider instanceof SupportInterface) {
            foreach ($provider->supports() as $supported) {
                $this->providerPool[$supported] = $provider;
            }
        } else {
            $this->providerPool[] = $provider;
        }
    }
}

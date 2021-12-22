<?php

namespace Vinecave\Bundle\RegistryBundle\Registry;

use Vinecave\Bundle\RegistryBundle\Exception\RegistryException;
use Vinecave\Bundle\CollectionBundle\Behavior\NamedInterface;

abstract class Registry
{
    protected array $providerPool;

    abstract public static function getProviderClass(): string;

    public function getProvider(string $name)
    {
        return $this->providerPool[$name] ?? null;
    }

    public function getProviders(): array
    {
        return $this->providerPool;
    }

    public function hasProvider(string $name): bool
    {
        return isset($this->providerPool[$name]);
    }

    /**
     * @param $provider
     * @throws RegistryException
     */
    public function addProvider($provider)
    {
        $this->validateProvider($provider);

        if ($provider instanceof NamedInterface) {
            $this->providerPool[$provider::getName()] = $provider;
        } else {
            $this->providerPool[] = $provider;
        }
    }

    /**
     * @param $provider
     * @throws RegistryException
     */
    protected function validateProvider($provider)
    {
        $providerClass = $this->getProviderClass();

        if (!is_object($provider)) {
            throw RegistryException::providerIsNotObject($this, $provider);
        }

        if (!is_a($provider, $providerClass)) {
            throw RegistryException::invalidProviderClass($this, $provider);
        }
    }
}

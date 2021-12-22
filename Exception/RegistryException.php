<?php

namespace Vinecave\Bundle\RegistryBundle\Exception;

use Vinecave\Bundle\RegistryBundle\Registry\Registry;
use Exception;

class RegistryException extends Exception
{
    private const INVALID_PROVIDER_CLASS = 1;
    private const PROVIDER_IS_NOT_OBJECT = 1;

    public static function invalidProviderClass(Registry $providerPool, $provider): RegistryException
    {
        $class = $providerPool->getProviderClass();
        $poolClass = $providerPool::class;
        $givenClass = $provider::class;

        return new self(
            "Provider $givenClass must implement or extend $class to be added into $poolClass"
        );
    }

    public static function providerIsNotObject(Registry $providerPool, $variable): RegistryException
    {
        $poolClass = $providerPool::class;
        $class = $providerPool->getProviderClass();

        return new self(
            "Provider must implement or extend $class to be added into $poolClass. Passed $variable instead."
        );
    }
}

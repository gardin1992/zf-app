<?php

namespace Base;

use Base\User\MemoryIdentityMap;
use Base\User\PostgresDataMapper;
use Base\User\Repository as UserRepository;
use Base\User\RepositoryFactory;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ServiceProviderInterface
{
    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                PostgresDataMapper::class => InvokableFactory::class,
                MemoryIdentityMap::class => InvokableFactory::class,
                UserRepository::class => RepositoryFactory::class
            ]
        ];
    }
}
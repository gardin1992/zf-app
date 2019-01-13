<?php

namespace Base\User;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Base\User\Repository as UserRepository;

class RepositoryFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $serviceManager, $requestedName, array $options = null) {

        $identityMap = $serviceManager->get(MemoryIdentityMap::class);
        $dataMapper = $serviceManager->get(PostgresDataMapper::class);
        return new UserRepository($identityMap, $dataMapper);
    }
}
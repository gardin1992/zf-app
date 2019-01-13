<?php

namespace BaseTest\User;

use Base\User\DataMapperInterface;
use Base\User\IdentityMapInterface;
use Base\User\MemoryIdentityMap;
use Base\User\PostgresDataMapper;
use Base\User\Repository;
use Base\User\RepositoryFactory;
use Zend\ServiceManager\ServiceManager;

class RepositoryFactoryTest extends \PHPUnit_Framework_TestCase
{

    function testCanCreateUserRepository() {
        $sm = new ServiceManager();
        $sm->setFactory(MemoryIdentityMap::class, function() {
            return new class() implements IdentityMapInterface {
            };
        });
        $sm->setFactory(PostgresDataMapper::class, function() {
            return new class() implements DataMapperInterface {
            };
        });
        $factory = new RepositoryFactory();
        $repository = $factory($sm, RepositoryFactory::class);
        $this->assertInstanceOf(Repository::class, $repository);
    }

}
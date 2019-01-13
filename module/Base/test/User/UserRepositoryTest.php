<?php

namespace BaseTest\User;

use Base\User\DataMapperInterface;
use Base\User\IdentityMapInterface;
use Base\User\Repository;


/** PHP 5 version
class IdentityMapStub implements User\IdentityMapInterface {

}

class DataMapperStub implements User\DataMapperInterface {

}
 */

class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCanCreateUserRepositoryObject() {
        /* PHP 5 version
        $identityMapStub = new IdentityMapStub();
        $dataMapperStub = new DataMapperStub();
        */
        $identityMapStub = new class() implements IdentityMapInterface {
        };
        $dataMapperStub = new class() implements DataMapperInterface {
        };
        $repository = new Repository($identityMapStub, $dataMapperStub);

        $this->assertInstanceOf(Repository::class, $repository);
    }
}
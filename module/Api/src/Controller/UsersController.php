<?php

namespace Api\Controller;

use Api\Model\UserTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UsersController extends AbstractRestfulController {

    /**
     * @var UserTable
     */
    protected $table;

    public function __construct(UserTable $table) {

        $this->table = $table;
    }

    public function getList()
    {

        $users = $this->table->fetchAll();

        $result = new JsonModel(array(
            'users' => $users->toArray(),
            'success' => true,
        ));

        return $result;
    }
}
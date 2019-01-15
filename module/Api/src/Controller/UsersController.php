<?php

namespace Api\Controller;

use Api\Model\User;
use Api\Model\UserTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UsersController extends AbstractRestfulController
{

    /**
     * @var UserTable
     */
    protected $table;

    public function __construct(UserTable $table)
    {

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

    public function get($id)
    {

        $user = $this->table->getUser($id);

        $result = new JsonModel([
            'user' => $user->getArrayCopy(),
            'success' => true
        ]);

        return $result;
    }


    protected function _isValidateData($data)
    {

        $hasName = isset($data['name']) && !empty($data['name']);
        $hasEmail = isset($data['email']) && !empty($data['email']);
        $hasPassword = isset($data['password']) && !empty($data['password']);

        return $hasName || $hasEmail || $hasPassword;
    }

    public function create($data)
    {

        $data['password'] = '123456';

        if ($this->_isValidateData($data)) {

            $user = new User();
            $user->exchangeArray($data);

            $this->table->saveUser($user);

            $result = [
                'user' => $user->getArrayCopy(),
                'success' => true
            ];
        } else {

            $result = [
                'success' => false,
                'data' => $data
            ];
        }

        return new JsonModel($result);
    }

    /**
     * x-www-form-urlencoded para receber os dados do form
     * @param mixed $id
     * @param mixed $data
     *
     * @return mixed|JsonModel
     */
    public function update($id, $data)
    {

        $user = $this->table->getUser($id);

        if ($this->_isValidateData($data)) {

            if (isset($data['name']))
                $user->setName($data['name']);

            if (isset($data['email']))
                $user->setEmail($data['email']);

            if (isset($data['password']))
                $user->setPassword($data['password']);

            $this->table->saveUser($user);

            $result = [
                'success' => true,
                'user' => $user->getArrayCopy()
            ];
        } else {

            $result = [
                'success' => false,
                'user' => $data
            ];
        }

        return new JsonModel($result);
    }

    public function delete($id)
    {

        $user = $this->table->getUser($id);

        if (!empty($user)) {

            $this->table->deleteUser($user->getIdUser());

            $result = [
                'success' => true,
                'msg' => 'Usuário deletado com sucesso'
            ];
        } else {

            $result = [
                'success' => false
            ];
        }

        return new JsonModel($result);
    }
}
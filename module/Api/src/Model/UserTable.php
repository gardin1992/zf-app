<?php

namespace Api\Model;


use Zend\Db\TableGateway\TableGatewayInterface;

class UserTable
{

    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {

        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id)
    {

        $current = $this->tableGateway->select([
            'id_user' => $id
        ]);

        return $current->current();
    }

    public function deleteUser(int $id)
    {

        $this->tableGateway->delete([
            'id_user' => $id
        ]);
    }

    public function saveUser(User $user)
    {
        $data = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ];

        //For update user
        if ($user->getIdUser()) {

            $this->tableGateway->update($data, [
                'id_user' => $user->getIdUser()
            ]);

            //For insert new user
        } else {
            $this->tableGateway->insert($data);
        }
    }
}
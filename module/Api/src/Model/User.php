<?php

namespace Api\Model;


class User
{

    private $id_user;
    private $name;
    private $email;
    private $password;

    public function exchangeArray(array $data)
    {

        $this->id_user = $data['id_user'];
        $this->name= $data['name'];
        $this->email= $data['email'];
        $this->password = $data['password'];
    }

    public function getArrayCopy()
    {

        return [
            'id_user'    => $this->id_user,
            'name'  => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
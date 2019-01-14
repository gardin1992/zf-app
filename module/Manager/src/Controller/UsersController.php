<?php

namespace Manager\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsersController extends AbstractActionController
{

    /**
     * @var
     */
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {

        $users = $this->table->fetchAll();

        return new ViewModel([
            'users' => $users
        ]);
    }
}
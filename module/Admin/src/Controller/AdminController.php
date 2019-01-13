<?php

namespace Admin\Controller;


use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class AdminController extends AbstractActionController
{

    /**
     * @var TableGateway
     */
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function indexAction() {

        return new ViewModel();

    }

    public function userAction() {

        return new ViewModel();
    }

    public function usersAction() {

        $rowset = $this->table->select();

        echo $rowset->count() . "<br>";

        foreach ($rowset as $projectRow) {
            echo $projectRow->getName() . PHP_EOL;
        }

//        $users = $this->table->fetchAll();
        return new ViewModel();

    }
}
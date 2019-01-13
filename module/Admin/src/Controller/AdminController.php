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

        $env = getenv('APP_ENV') ?: 'production';

        $table = $this->table->getTable();
        $rowset = $this->table->select();

        foreach ($rowset as $projectRow) {
            echo $projectRow['name'] . PHP_EOL;
        }

//        $users = $this->table->fetchAll();

        echo '<pre>';
        print_r($table);
        echo '</pre>';
        return new ViewModel();

    }
}
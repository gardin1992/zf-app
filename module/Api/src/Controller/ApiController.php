<?php

namespace Api\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractRestfulController
{

    public function indexAction() {

        $result = new JsonModel(array(
            'some_parameter' => 'some value',
            'success'=>true,
        ));

        return $result;
    }

}
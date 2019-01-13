<?php

namespace Admin;


use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Admin\Model\User;
use Admin\Model\UserTable;

class Module implements ConfigProviderInterface, ServiceProviderInterface
{

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UserTable::class => function ($container) {
                    $tableGateway = $container->get(UserTable::class);
                    return new Model\UserTable($tableGateway);
                },
                Model\UserTable::class => function ($container) {

                    $adapater = $container->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User);
                    return new TableGateway('user', $adapater, null, $resultSetPrototype);
                }
            ]
        ];
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AdminController::class => function ($container) {

                    return new Controller\AdminController(
                        $container->get(Model\UserTable::class)
                    );
                }
            ]
        ];
    }

}
<?php

namespace Api;


use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\ServiceManager;

class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{


    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UserTable::class => function (ServiceManager $container) {

                    $tableGateway = $container->get('UserTableGateway');
                    $table = new Model\UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway'=> function (ServiceManager $container) {

                    $adapter = $container->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\User);
                    return new TableGateway('users', $adapter, null, $resultSetPrototype);
                }
            ]
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to seed
     * such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\UsersController::class => function (ServiceManager $container) {

                    return new Controller\UsersController(
                        $container->get(Model\UserTable::class)
                    );
                }
            ]
        ];
    }
}
<?php

namespace Manager;

use Base\Model\UserTable;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\ServiceManager;

class Module implements ConfigProviderInterface
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

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\UsersController::class => function (ServiceManager $container) {

                    return new Controller\UsersController(
                        $container->get(UserTable::class)
                    );
                }
            ]
        ];
    }
}
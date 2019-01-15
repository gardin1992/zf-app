<?php

namespace Api;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'router' => [
        'routes' => [
            'api' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/api',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'index',
                        'format' => 'json'
                    ],
                ],
            ],
            'api.users' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/users[/:id][/]',
                    'constraints' => array(
//                        'format' => '(json)',
                    ),
                    'defaults' => array(
                        'controller' => Controller\UsersController::class,
//                        'format' => 'json',
                    ),
                ),
            ),
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\ApiController::class => InvokableFactory::class,
//            Controller\UsersController::class => InvokableFactory::class
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'api/index/index' => __DIR__ . '/../view/api/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ],
];
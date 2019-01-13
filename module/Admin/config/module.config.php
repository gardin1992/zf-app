<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

use Admin\Controller\AdminController;

return [
    'router' => [
        'routes' => [

            'user' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/user',
                    'defaults' => [
                        'controller' => AdminController::class,
                        'action'     => 'user',
                    ],
                ],
            ],
            'users' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/users',
                    'defaults' => [
                        'controller' => AdminController::class,
                        'action'     => 'users',
                    ],
                ],
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

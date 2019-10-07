<?php

namespace Carteira;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
/*     'controllers' => [
        'factories' => [
            Controller\CarteiraController:: class => InvokableFactory::class
        ],
    ], */

    'router' => [
        'routes' => [
            'carteira' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/carteira[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CarteiraController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'carteira' => __DIR__ . '/../view',
        ],
    ],
];
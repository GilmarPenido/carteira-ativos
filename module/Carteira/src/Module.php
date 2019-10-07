<?php

namespace Carteira; 

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterfa;

class Module implements ConfigProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\CarteiraTable::class => function($container) {
                    $tableGateway = $container->get(Model\CarteiraTableGateway::class);
                    return new Model\CarteiraTable($tableGateway);
                },
                Model\CarteiraTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Carteira());
                    return new TableGateway('carteira', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\CarteiraController::class => function($container) {
                    return new Controller\CarteiraController(
                        $container->get(Model\CarteiraTable::class)
                    );
                },
            ],
        ];
    }

}
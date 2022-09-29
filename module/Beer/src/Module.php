<?php

namespace Beer;

use Beer\Controller\BeerController;
use Beer\Model\Beer;
use Beer\Model\BeerTable;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface {
    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig() {
        return [
            'factories' => [
                BeerController::class => function($container) {
                    return new BeerController($container->get(BeerTable::class));
                }
            ]
        ];
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                BeerTable::class => function($container) {
                    $tableGateway = $container->get(Model\BeerTableGateway::class);
                    return new BeerTable($tableGateway);
                },
                Model\BeerTableGateway::class => function($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Beer());
                    return new TableGateway('beers', $dbAdapter, null, $resultSetPrototype);
                }
            ],
        ];
    }
}
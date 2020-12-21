<?php

namespace Container2j1xJgf;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_DoctrineMongodb_Odm_AggregationExtension_PaginationService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'api_platform.doctrine_mongodb.odm.aggregation_extension.pagination' shared service.
     *
     * @return \ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\Extension\PaginationExtension
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Doctrine/MongoDbOdm/Extension/AggregationCollectionExtensionInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Doctrine/MongoDbOdm/Extension/AggregationResultCollectionExtensionInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Doctrine/MongoDbOdm/Extension/PaginationExtension.php';

        return $container->privates['api_platform.doctrine_mongodb.odm.aggregation_extension.pagination'] = new \ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\Extension\PaginationExtension(($container->services['doctrine_mongodb'] ?? $container->getDoctrineMongodbService()), ($container->privates['api_platform.pagination'] ?? $container->load('getApiPlatform_PaginationService')));
    }
}
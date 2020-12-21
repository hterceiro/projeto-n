<?php

namespace Container2j1xJgf;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_DoctrineMongodb_Odm_Default_SubresourceDataProviderService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'api_platform.doctrine_mongodb.odm.default.subresource_data_provider' shared service.
     *
     * @return \ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\SubresourceDataProvider
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Doctrine/Common/Util/IdentifierManagerTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Doctrine/MongoDbOdm/SubresourceDataProvider.php';

        return $container->privates['api_platform.doctrine_mongodb.odm.default.subresource_data_provider'] = new \ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\SubresourceDataProvider(($container->services['doctrine_mongodb'] ?? $container->getDoctrineMongodbService()), ($container->privates['api_platform.metadata.property.name_collection_factory.cached'] ?? $container->getApiPlatform_Metadata_Property_NameCollectionFactory_CachedService()), ($container->privates['api_platform.metadata.property.metadata_factory.cached'] ?? $container->getApiPlatform_Metadata_Property_MetadataFactory_CachedService()), new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['api_platform.doctrine_mongodb.odm.aggregation_extension.filter'] ?? $container->load('getApiPlatform_DoctrineMongodb_Odm_AggregationExtension_FilterService'));
            yield 1 => ($container->privates['api_platform.doctrine_mongodb.odm.aggregation_extension.order'] ?? $container->load('getApiPlatform_DoctrineMongodb_Odm_AggregationExtension_OrderService'));
            yield 2 => ($container->privates['api_platform.doctrine_mongodb.odm.aggregation_extension.pagination'] ?? $container->load('getApiPlatform_DoctrineMongodb_Odm_AggregationExtension_PaginationService'));
        }, 3), new RewindableGenerator(function () use ($container) {
            return new \EmptyIterator();
        }, 0));
    }
}

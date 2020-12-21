<?php

namespace ContainerIWByvNo;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_DoctrineMongodb_Odm_DefaultDocumentManager_PropertyInfoExtractorService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'api_platform.doctrine_mongodb.odm.default_document_manager.property_info_extractor' shared service.
     *
     * @return \ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\PropertyInfo\DoctrineExtractor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Bridge/Doctrine/MongoDbOdm/PropertyInfo/DoctrineExtractor.php';

        return $container->privates['api_platform.doctrine_mongodb.odm.default_document_manager.property_info_extractor'] = new \ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\PropertyInfo\DoctrineExtractor(($container->services['doctrine_mongodb.odm.default_document_manager'] ?? $container->load('getDoctrineMongodb_Odm_DefaultDocumentManagerService')));
    }
}

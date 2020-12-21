<?php

namespace Container2j1xJgf;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCpfCnpjValidatorService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Validator\CpfCnpjValidator' shared autowired service.
     *
     * @return \App\Validator\CpfCnpjValidator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/validator/ConstraintValidator.php';
        include_once \dirname(__DIR__, 4).'/src/Validator/CpfCnpjValidator.php';

        return $container->privates['App\\Validator\\CpfCnpjValidator'] = new \App\Validator\CpfCnpjValidator();
    }
}

<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class CpfCnpj
 * @package App\Validator
 * @Annotation
 */
class CpfCnpj extends Constraint
{
    public $message = '{{ string }}';
}
<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CpfCnpjValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if ($constraint instanceof CpfCnpj) {
            $document = null;
            $message = '';

            if (strlen($value) == 11) {
                $document = new \Bissolli\ValidadorCpfCnpj\CPF($value);
                $message = sprintf("O valor %s não é um CPF valido", $value);
            }

            if (strlen($value) == 14) {
                $document = new \Bissolli\ValidadorCpfCnpj\CNPJ($value);
                $message = sprintf("O valor %s não é um CNPJ valido", $value);
            }

            if (is_null($document)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', 'O valor informado não é um CPF/CNPJ!')
                    ->addViolation();

                return;
            }

            if (!$document->isValid()) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', $message)
                    ->addViolation();
            }
        }
    }
}
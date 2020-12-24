<?php

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as CustomAssert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @ApiResource()
 * @MongoDBUnique(fields="numero")
 * @ODM\Document
 */
class Documento
{
    /**
     * @ODM\Id(strategy="INCREMENT", type="integer")
     */
    private $id;

    /**
     * @ODM\Field
     * @Assert\NotBlank()
     * @CustomAssert\CpfCnpj()
     */
    public ?string $numero;

    /**
     * @return string|null
     */
    public function getNumero(): ?string
    {
        return $this->numero;
    }

    /**
     * @param string|null $numero
     */
    public function setNumero(?string $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
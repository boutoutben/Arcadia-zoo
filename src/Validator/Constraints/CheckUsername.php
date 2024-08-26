<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Annotation
 */

class CheckUsername extends Assert\Compound
{
    protected function getConstraints(array $options):array
    {
        return[
            new Assert\NotBlank(message: "Le champ ne doit pas être vide")
        ];
    }
}
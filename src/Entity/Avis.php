<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    //#[Assert\CheckUsername()]
    private ?string $pseudo = null;

    #[ORM\Column(length: 510)]
    private ?string $avis = null;

    #[ORM\Column]
    private ?bool $isValid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): void
    {
        $this->avis = $avis;
    }

    public function isValid(): ?bool
    {
        return $this->isValid;
    }

    public function setValid(?bool $isValid): void
    {
        $this->isValid = $isValid;

    }
}

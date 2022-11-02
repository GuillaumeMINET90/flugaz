<?php

namespace App\Entity;

use App\Repository\RefrigerantsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RefrigerantsRepository::class)]
class Refrigerants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $refrigerant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefrigerant(): ?string
    {
        return $this->refrigerant;
    }

    public function setRefrigerant(string $refrigerant): self
    {
        $this->refrigerant = $refrigerant;

        return $this;
    }
}

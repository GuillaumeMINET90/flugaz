<?php

namespace App\Entity;

use App\Repository\NewContainersMovementsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewContainersMovementsRepository::class)]
class NewContainersMovements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'newContainersMovements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NewContainers $new_container = null;

    #[ORM\Column]
    private ?float $quantity_rest = null;

    #[ORM\Column]
    private ?float $quantity_injected = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 15)]
    private ?string $cerfa_number = null;

    #[ORM\Column(length: 255)]
    private ?string $customer = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remark = null;

    #[ORM\ManyToOne(inversedBy: 'newContainersMovements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $technicien = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewContainer(): ?NewContainers
    {
        return $this->new_container;
    }

    public function setNewContainer(?NewContainers $new_container): self
    {
        $this->new_container = $new_container;

        return $this;
    }

    public function getQuantityRest(): ?float
    {
        return $this->quantity_rest;
    }

    public function setQuantityRest(float $quantity_rest): self
    {
        $this->quantity_rest = $quantity_rest;

        return $this;
    }

    public function getQuantityInjected(): ?float
    {
        return $this->quantity_injected;
    }

    public function setQuantityInjected(float $quantity_injected): self
    {
        $this->quantity_injected = $quantity_injected;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCerfaNumber(): ?string
    {
        return $this->cerfa_number;
    }

    public function setCerfaNumber(string $cerfa_number): self
    {
        $this->cerfa_number = $cerfa_number;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getRemark(): ?string
    {
        return $this->remark;
    }

    public function setRemark(?string $remark): self
    {
        $this->remark = $remark;

        return $this;
    }

    public function getTechnicien(): ?User
    {
        return $this->technicien;
    }

    public function setTechnicien(?User $technicien): self
    {
        $this->technicien = $technicien;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\RecoveryContainersMovementsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecoveryContainersMovementsRepository::class)]
class RecoveryContainersMovements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recoveryContainersMovements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecoveryContainers $recovery_container = null;

    #[ORM\Column]
    private ?float $quantity_recovered = null;

    #[ORM\ManyToOne(inversedBy: 'recoveryContainersMovements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $technicien = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 15)]
    private ?string $cerfa_number = null;

    #[ORM\Column(length: 255)]
    private ?string $customer = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remark = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecoveryContainer(): ?RecoveryContainers
    {
        return $this->recovery_container;
    }

    public function setRecoveryContainer(?RecoveryContainers $recovery_container): self
    {
        $this->recovery_container = $recovery_container;

        return $this;
    }

    public function getQuantityRecovered(): ?float
    {
        return $this->quantity_recovered;
    }

    public function setQuantityRecovered(float $quantity_recovered): self
    {
        $this->quantity_recovered = $quantity_recovered;

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
}

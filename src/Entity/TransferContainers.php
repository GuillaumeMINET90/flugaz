<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TransferContainersRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TransferContainersRepository::class)]
#[UniqueEntity(fields: ['number' ], message: 'Ce numéro de bouteille existe déjà.')]
class TransferContainers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Length(
        min: 5,
        max: 10,
        minMessage: 'Le numéro ne peut être inférieur à {{ limit }} ',
        maxMessage: 'Le numéro ne peut être supérieur à {{ limit }} ',
    )]
    private ?int $number = null;

    #[ORM\Column(length: 8, nullable: true)]
    private ?string $gaz = null;

    #[ORM\Column]
    private ?float $tare = null;

    #[ORM\ManyToOne(inversedBy: 'transferContainers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vendors $vendor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\LessThan(value:'tomorrow', message:'La date ne peut pas être supérieure à {{ compared_value }}')]
    private ?\DateTimeInterface $purchase_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\LessThan(value:'tomorrow', message:'La date ne peut pas être supérieure à {{ compared_value }}')]
    private ?\DateTimeInterface $return_date = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_weight = null;

    #[ORM\Column]
    #[Assert\LessThan(
        value: 62,
        message: 'Le volume ne peut pas être supérieur à {{ compared_value }} kg.',)]
    #[Assert\GreaterThan(
        value:12,
        message:'Le volume ne peut pas être inférieur à {{ compared_value }} kg.')]
    private ?int $volume = null;

    #[ORM\Column(nullable: true)]
    private ?bool $used_container = null;

    #[ORM\ManyToOne(inversedBy: 'transferContainers')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getGaz(): ?string
    {
        return $this->gaz;
    }

    public function setGaz(?string $gaz): self
    {
        $this->gaz = $gaz;

        return $this;
    }

    public function getTare(): ?float
    {
        return $this->tare;
    }

    public function setTare(float $tare): self
    {
        $this->tare = $tare;

        return $this;
    }

    public function getVendor(): ?Vendors
    {
        return $this->vendor;
    }

    public function setVendor(?Vendors $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchase_date;
    }

    public function setPurchaseDate(\DateTimeInterface $purchase_date): self
    {
        $this->purchase_date = $purchase_date;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->return_date;
    }

    public function setReturnDate(?\DateTimeInterface $return_date): self
    {
        $this->return_date = $return_date;

        return $this;
    }

    public function getTotalWeight(): ?float
    {
        return $this->total_weight;
    }

    public function setTotalWeight(?float $total_weight): self
    {
        $this->total_weight = $total_weight;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function isUsedContainer(): ?bool
    {
        return $this->used_container;
    }

    public function setUsedContainer(?bool $used_container): self
    {
        $this->used_container = $used_container;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

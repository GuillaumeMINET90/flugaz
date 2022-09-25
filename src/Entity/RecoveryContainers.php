<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\RecoveryContainersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RecoveryContainersRepository::class)]
#[UniqueEntity(fields: ['number' ], message: 'Ce numéro de bouteille existe déjà.')]
class RecoveryContainers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 8)]
    private ?string $gaz = null;

    #[ORM\Column]
    private ?float $tare = null;

    #[ORM\ManyToOne(inversedBy: 'recoveryContainers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vendors $vendor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $purchase_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $return_date = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_weight = null;

    #[ORM\OneToMany(mappedBy: 'recovery_container', targetEntity: RecoveryContainersMovements::class)]
    private Collection $recoveryContainersMovements;

    public function __construct()
    {
        $this->recoveryContainersMovements = new ArrayCollection();
    }

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

    public function setGaz(string $gaz): self
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

    /**
     * @return Collection<int, RecoveryContainersMovements>
     */
    public function getRecoveryContainersMovements(): Collection
    {
        return $this->recoveryContainersMovements;
    }

    public function addRecoveryContainersMovement(RecoveryContainersMovements $recoveryContainersMovement): self
    {
        if (!$this->recoveryContainersMovements->contains($recoveryContainersMovement)) {
            $this->recoveryContainersMovements->add($recoveryContainersMovement);
            $recoveryContainersMovement->setRecoveryContainer($this);
        }

        return $this;
    }

    public function removeRecoveryContainersMovement(RecoveryContainersMovements $recoveryContainersMovement): self
    {
        if ($this->recoveryContainersMovements->removeElement($recoveryContainersMovement)) {
            // set the owning side to null (unless already changed)
            if ($recoveryContainersMovement->getRecoveryContainer() === $this) {
                $recoveryContainersMovement->setRecoveryContainer(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewContainersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: NewContainersRepository::class)]
#[UniqueEntity(fields: ['number' ], message: 'Ce numéro de bouteille existe déjà.')]
class NewContainers
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

    #[ORM\Column(length: 8)]
    private ?string $gaz = null;

    #[ORM\Column]
    #[Assert\LessThan(
        value: 26,
        message: 'Le poid ne peut pas être supérieur à {{ compared_value }} kg.',)]
    #[Assert\GreaterThan(
        value:7,
        message:'Le poid ne peut pas être inférieur à {{ compared_value }} kg.')]
    private ?float $initial_weight = null;

    #[ORM\ManyToOne(inversedBy: 'newContainers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vendors $vendor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\LessThan(value:'tomorrow', message:'La date ne peut pas être supérieure à {{ compared_value }}')]
    private ?\DateTimeInterface $purchase_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\LessThan(value:'tomorrow', message:'La date ne peut pas être supérieure à {{ compared_value }}')]
    private ?\DateTimeInterface $return_date = null;

    #[ORM\OneToMany(mappedBy: 'new_container', targetEntity: NewContainersMovements::class)]
    private Collection $newContainersMovements;

    #[ORM\Column(length: 80)]
    private ?string $bill_number = null;

    public function __construct()
    {
        $this->newContainersMovements = new ArrayCollection();
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

    public function getInitialWeight(): ?float
    {
        return $this->initial_weight;
    }

    public function setInitialWeight(float $initial_weight): self
    {
        $this->initial_weight = $initial_weight;

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

    /**
     * @return Collection<int, NewContainersMovements>
     */
    public function getNewContainersMovements(): Collection
    {
        return $this->newContainersMovements;
    }

    public function addNewContainersMovement(NewContainersMovements $newContainersMovement): self
    {
        if (!$this->newContainersMovements->contains($newContainersMovement)) {
            $this->newContainersMovements->add($newContainersMovement);
            $newContainersMovement->setNewContainer($this);
        }

        return $this;
    }

    public function removeNewContainersMovement(NewContainersMovements $newContainersMovement): self
    {
        if ($this->newContainersMovements->removeElement($newContainersMovement)) {
            // set the owning side to null (unless already changed)
            if ($newContainersMovement->getNewContainer() === $this) {
                $newContainersMovement->setNewContainer(null);
            }
        }

        return $this;
    }

    public function getBillNumber(): ?string
    {
        return $this->bill_number;
    }

    public function setBillNumber(string $bill_number): self
    {
        $this->bill_number = $bill_number;

        return $this;
    }
}

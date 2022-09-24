<?php

namespace App\Entity;

use App\Repository\NewContainersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewContainersRepository::class)]
class NewContainers
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
    private ?float $initial_weight = null;

    #[ORM\ManyToOne(inversedBy: 'newContainers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vendors $vendor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $purchase_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $return_date = null;

    #[ORM\OneToMany(mappedBy: 'new_container', targetEntity: NewContainersMovements::class)]
    private Collection $newContainersMovements;

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
}

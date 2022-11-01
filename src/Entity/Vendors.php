<?php

namespace App\Entity;

use App\Repository\VendorsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendorsRepository::class)]
class Vendors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column]
    #[Assert\Regex('/[0-9]{5}/')]
    #[Assert\Length(
        min: 5,
        max: 5,
        minMessage: 'Le code postal ne peut être inférieur à {{ limit }} caractères',
        maxMessage: 'Le code postal ne peut être supérieur à {{ limit }} caractères',
    )]
    private ?int $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_active = null;
    
    #[ORM\OneToMany(mappedBy: 'vendor', targetEntity: NewContainers::class)]
    private Collection $newContainers;

    #[ORM\OneToMany(mappedBy: 'vendor', targetEntity: RecoveryContainers::class)]
    private Collection $recoveryContainers;

    #[ORM\OneToMany(mappedBy: 'vendor', targetEntity: TransferContainers::class)]
    private Collection $transferContainers;

    public function __construct()
    {
        $this->newContainers = new ArrayCollection();
        $this->recoveryContainers = new ArrayCollection();
        $this->transferContainers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, NewContainers>
     */
    public function getNewContainers(): Collection
    {
        return $this->newContainers;
    }

    public function addNewContainer(NewContainers $newContainer): self
    {
        if (!$this->newContainers->contains($newContainer)) {
            $this->newContainers->add($newContainer);
            $newContainer->setVendor($this);
        }

        return $this;
    }

    public function removeNewContainer(NewContainers $newContainer): self
    {
        if ($this->newContainers->removeElement($newContainer)) {
            // set the owning side to null (unless already changed)
            if ($newContainer->getVendor() === $this) {
                $newContainer->setVendor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecoveryContainers>
     */
    public function getRecoveryContainers(): Collection
    {
        return $this->recoveryContainers;
    }

    public function addRecoveryContainer(RecoveryContainers $recoveryContainer): self
    {
        if (!$this->RecoveryContainers->contains($recoveryContainer)) {
            $this->RecoveryContainers->add($recoveryContainer);
            $recoveryContainer->setVendor($this);
        }

        return $this;
    }

    public function removeRecoveryContainer(RecoveryContainers $recoveryContainer): self
    {
        if ($this->RecoveryContainers->removeElement($recoveryContainer)) {
            // set the owning side to null (unless already changed)
            if ($recoveryContainer->getVendor() === $this) {
                $recoveryContainer->setVendor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TransferContainers>
     */
    public function getTransferContainers(): Collection
    {
        return $this->transferContainers;
    }

    public function addTransferContainer(TransferContainers $transferContainer): self
    {
        if (!$this->transferContainers->contains($transferContainer)) {
            $this->transferContainers->add($transferContainer);
            $transferContainer->setVendor($this);
        }

        return $this;
    }

    public function removeTransferContainer(TransferContainers $transferContainer): self
    {
        if ($this->transferContainers->removeElement($transferContainer)) {
            // set the owning side to null (unless already changed)
            if ($transferContainer->getVendor() === $this) {
                $transferContainer->setVendor(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

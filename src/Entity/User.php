<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $fullname = null;
    
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_active = null;

    #[ORM\Column(length: 30)]
    private ?string $certificate = null;

    #[ORM\OneToMany(mappedBy: 'technicien', targetEntity: NewContainersMovements::class)]
    private Collection $newContainersMovements;

    #[ORM\OneToMany(mappedBy: 'technicien', targetEntity: RecoveryContainersMovements::class)]
    private Collection $recoveryContainersMovements;

    #[ORM\OneToMany(mappedBy: 'technicien', targetEntity: Tools::class)]
    private Collection $tools;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: TransferContainers::class)]
    private Collection $transferContainers;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    public function __construct()
    {
        $this->newContainersMovements = new ArrayCollection();
        $this->recoveryContainersMovements = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->transferContainers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getCertificate(): ?string
    {
        return $this->certificate;
    }

    public function setCertificate(string $certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

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
            $newContainersMovement->setTechnicien($this);
        }

        return $this;
    }

    public function removeNewContainersMovement(NewContainersMovements $newContainersMovement): self
    {
        if ($this->newContainersMovements->removeElement($newContainersMovement)) {
            // set the owning side to null (unless already changed)
            if ($newContainersMovement->getTechnicien() === $this) {
                $newContainersMovement->setTechnicien(null);
            }
        }

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
            $recoveryContainersMovement->setTechnicien($this);
        }

        return $this;
    }

    public function removeRecoveryContainersMovement(RecoveryContainersMovements $recoveryContainersMovement): self
    {
        if ($this->recoveryContainersMovements->removeElement($recoveryContainersMovement)) {
            // set the owning side to null (unless already changed)
            if ($recoveryContainersMovement->getTechnicien() === $this) {
                $recoveryContainersMovement->setTechnicien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tools>
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tools $tool): self
    {
        if (!$this->tools->contains($tool)) {
            $this->tools->add($tool);
            $tool->setTechnicien($this);
        }

        return $this;
    }

    public function removeTool(Tools $tool): self
    {
        if ($this->tools->removeElement($tool)) {
            // set the owning side to null (unless already changed)
            if ($tool->getTechnicien() === $this) {
                $tool->setTechnicien(null);
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
            $transferContainer->setUser($this);
        }

        return $this;
    }

    public function removeTransferContainer(TransferContainers $transferContainer): self
    {
        if ($this->transferContainers->removeElement($transferContainer)) {
            // set the owning side to null (unless already changed)
            if ($transferContainer->getUser() === $this) {
                $transferContainer->setUser(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}

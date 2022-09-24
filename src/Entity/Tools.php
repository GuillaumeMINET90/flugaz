<?php

namespace App\Entity;

use App\Repository\ToolsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolsRepository::class)]
class Tools
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $type = null;

    #[ORM\Column(length: 100)]
    private ?string $denomination = null;

    #[ORM\Column(length: 60)]
    private ?string $serial_number = null;

    #[ORM\ManyToOne(inversedBy: 'tools')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $technicien = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $control_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $next_control = null;

    #[ORM\Column(length: 60)]
    private ?string $control_certificate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(string $serial_number): self
    {
        $this->serial_number = $serial_number;

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

    public function getControlDate(): ?\DateTimeInterface
    {
        return $this->control_date;
    }

    public function setControlDate(\DateTimeInterface $control_date): self
    {
        $this->control_date = $control_date;

        return $this;
    }

    public function getNextControl(): ?\DateTimeInterface
    {
        return $this->next_control;
    }

    public function setNextControl(\DateTimeInterface $next_control): self
    {
        $this->next_control = $next_control;

        return $this;
    }

    public function getControlCertificate(): ?string
    {
        return $this->control_certificate;
    }

    public function setControlCertificate(string $control_certificate): self
    {
        $this->control_certificate = $control_certificate;

        return $this;
    }
}

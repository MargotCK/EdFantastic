<?php

namespace App\Entity;

use App\Repository\AdresseFactureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseFactureRepository::class)]
class AdresseFacture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $rueFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $villeFacture = null;

    #[ORM\Column(length: 50)]
    private ?string $codePostalFacture = null;

    #[ORM\ManyToOne(inversedBy: 'AdresseFacture')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRueFacture(): ?string
    {
        return $this->rueFacture;
    }

    public function setRueFacture(string $rueFacture): static
    {
        $this->rueFacture = $rueFacture;

        return $this;
    }

    public function getVilleFacture(): ?string
    {
        return $this->villeFacture;
    }

    public function setVilleFacture(string $villeFacture): static
    {
        $this->villeFacture = $villeFacture;

        return $this;
    }

    public function getCodePostalFacture(): ?string
    {
        return $this->codePostalFacture;
    }

    public function setCodePostalFacture(string $codePostalFacture): static
    {
        $this->codePostalFacture = $codePostalFacture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

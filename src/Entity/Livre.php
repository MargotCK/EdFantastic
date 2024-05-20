<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $ean = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $format = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantiteStock = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resume = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couv1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couv4 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEan(): ?int
    {
        return $this->ean;
    }

    public function setEan(int $ean): static
    {
        $this->ean = $ean;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): static
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getQuantiteStock(): ?int
    {
        return $this->quantiteStock;
    }

    public function setQuantiteStock(?int $quantiteStock): static
    {
        $this->quantiteStock = $quantiteStock;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getCouv1(): ?string
    {
        return $this->couv1;
    }

    public function setCouv1(?string $couv1): static
    {
        $this->couv1 = $couv1;

        return $this;
    }

    public function getCouv4(): ?string
    {
        return $this->couv4;
    }

    public function setCouv4(?string $couv4): static
    {
        $this->couv4 = $couv4;

        return $this;
    }
}

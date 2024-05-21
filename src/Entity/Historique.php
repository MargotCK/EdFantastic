<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueRepository::class)]
class Historique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateHistorique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHistorique(): ?\DateTimeInterface
    {
        return $this->dateHistorique;
    }

    public function setDateHistorique(\DateTimeInterface $dateHistorique): static
    {
        $this->dateHistorique = $dateHistorique;

        return $this;
    }
}

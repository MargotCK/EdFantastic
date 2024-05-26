<?php

namespace App\Entity;

use App\Repository\AdresseLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseLivraisonRepository::class)]
class AdresseLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $rueAdresseLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $villeAdresseLivraison = null;

    #[ORM\Column(length: 30)]
    private ?string $codePostalLivraison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'AdresseLivraison')]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'AdresseLivraison')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRueAdresseLivraison(): ?string
    {
        return $this->rueAdresseLivraison;
    }

    public function setRueAdresseLivraison(string $rueAdresseLivraison): static
    {
        $this->rueAdresseLivraison = $rueAdresseLivraison;

        return $this;
    }

    public function getVilleAdresseLivraison(): ?string
    {
        return $this->villeAdresseLivraison;
    }

    public function setVilleAdresseLivraison(string $villeAdresseLivraison): static
    {
        $this->villeAdresseLivraison = $villeAdresseLivraison;

        return $this;
    }

    public function getCodePostalLivraison(): ?string
    {
        return $this->codePostalLivraison;
    }

    public function setCodePostalLivraison(string $codePostalLivraison): static
    {
        $this->codePostalLivraison = $codePostalLivraison;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

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

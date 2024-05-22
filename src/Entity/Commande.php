<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numéro = null;

    #[ORM\Column(length: 50)]
    private ?string $moyenPaiement = null;

    #[ORM\Column]
    private ?float $tauxTva = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column]
    private ?float $montantTtc = null;

    #[ORM\Column(length: 255)]
    private ?string $statutCommande = null;

    /**
     * @var Collection<int, LigneCommande>
     */
    #[ORM\OneToMany(targetEntity: LigneCommande::class, mappedBy: 'commande')]
    private Collection $LigneCommande;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Historique $Historique = null;

    /**
     * @var Collection<int, AdresseLivraison>
     */
    #[ORM\OneToMany(targetEntity: AdresseLivraison::class, mappedBy: 'commande')]
    private Collection $AdresseLivraison;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?AdresseFacture $AdresseFacture = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $User = null;

    public function __construct()
    {
        $this->LigneCommande = new ArrayCollection();
        $this->AdresseLivraison = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNuméro(): ?int
    {
        return $this->numéro;
    }

    public function setNuméro(int $numéro): static
    {
        $this->numéro = $numéro;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(string $moyenPaiement): static
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    public function getTauxTva(): ?float
    {
        return $this->tauxTva;
    }

    public function setTauxTva(float $tauxTva): static
    {
        $this->tauxTva = $tauxTva;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getMontantTtc(): ?float
    {
        return $this->montantTtc;
    }

    public function setMontantTtc(float $montantTtc): static
    {
        $this->montantTtc = $montantTtc;

        return $this;
    }

    public function getStatutCommande(): ?string
    {
        return $this->statutCommande;
    }

    public function setStatutCommande(string $statutCommande): static
    {
        $this->statutCommande = $statutCommande;

        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommande(): Collection
    {
        return $this->LigneCommande;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): static
    {
        if (!$this->LigneCommande->contains($ligneCommande)) {
            $this->LigneCommande->add($ligneCommande);
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): static
    {
        if ($this->LigneCommande->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getHistorique(): ?Historique
    {
        return $this->Historique;
    }

    public function setHistorique(?Historique $Historique): static
    {
        $this->Historique = $Historique;

        return $this;
    }

    /**
     * @return Collection<int, AdresseLivraison>
     */
    public function getAdresseLivraison(): Collection
    {
        return $this->AdresseLivraison;
    }

    public function addAdresseLivraison(AdresseLivraison $adresseLivraison): static
    {
        if (!$this->AdresseLivraison->contains($adresseLivraison)) {
            $this->AdresseLivraison->add($adresseLivraison);
            $adresseLivraison->setCommande($this);
        }

        return $this;
    }

    public function removeAdresseLivraison(AdresseLivraison $adresseLivraison): static
    {
        if ($this->AdresseLivraison->removeElement($adresseLivraison)) {
            // set the owning side to null (unless already changed)
            if ($adresseLivraison->getCommande() === $this) {
                $adresseLivraison->setCommande(null);
            }
        }

        return $this;
    }

    public function getAdresseFacture(): ?AdresseFacture
    {
        return $this->AdresseFacture;
    }

    public function setAdresseFacture(?AdresseFacture $AdresseFacture): static
    {
        $this->AdresseFacture = $AdresseFacture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

   
    
}

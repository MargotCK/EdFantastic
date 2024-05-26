<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Age $Age = null;

    /**
     * @var Collection<int, Theme>
     */
    #[ORM\ManyToMany(targetEntity: Theme::class, inversedBy: 'livres')]
    private Collection $Theme;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?Genre $Genre = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?Illustrateur $Illustrateur = null;

    /**
     * @var Collection<int, Auteur>
     */
    #[ORM\ManyToMany(targetEntity: Auteur::class, inversedBy: 'livres')]
    private Collection $Auteur;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?Serie $Serie = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'livres')]
    private Collection $User;

    #[ORM\ManyToOne(inversedBy: 'Livre')]
    private ?Commande $commande = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbPage = null;

    

    public function __construct()
    {
        $this->Theme = new ArrayCollection();
        $this->Auteur = new ArrayCollection();
        $this->User = new ArrayCollection();
        
    }

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

    public function getAge(): ?Age
    {
        return $this->Age;
    }

    public function setAge(?Age $Age): static
    {
        $this->Age = $Age;

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getTheme(): Collection
    {
        return $this->Theme;
    }

    public function addTheme(Theme $theme): static
    {
        if (!$this->Theme->contains($theme)) {
            $this->Theme->add($theme);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): static
    {
        $this->Theme->removeElement($theme);

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->Genre;
    }

    public function setGenre(?Genre $Genre): static
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getIllustrateur(): ?Illustrateur
    {
        return $this->Illustrateur;
    }

    public function setIllustrateur(?Illustrateur $Illustrateur): static
    {
        $this->Illustrateur = $Illustrateur;

        return $this;
    }

    /**
     * @return Collection<int, Auteur>
     */
    public function getAuteur(): Collection
    {
        return $this->Auteur;
    }

    public function addAuteur(Auteur $auteur): static
    {
        if (!$this->Auteur->contains($auteur)) {
            $this->Auteur->add($auteur);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): static
    {
        $this->Auteur->removeElement($auteur);

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->Serie;
    }

    public function setSerie(?Serie $Serie): static
    {
        $this->Serie = $Serie;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(User $user): static
    {
        if (!$this->User->contains($user)) {
            $this->User->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->User->removeElement($user);

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

    public function getNbPage(): ?int
    {
        return $this->nbPage;
    }

    public function setNbPage(?int $nbPage): static
    {
        $this->nbPage = $nbPage;

        return $this;
    }

    
    
}

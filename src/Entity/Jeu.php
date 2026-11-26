<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuRepository::class)]
class Jeu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, unique: true, nullable: false)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $nbJoueurs = null;

    #[ORM\Column(length: 255)]
    private ?string $dureeMoyenne = null;

    #[ORM\Column(length: 255)]
    private ?string $ageMinimum = null;

    /**
     * @var Collection<int, Soiree>
     */
    #[ORM\OneToMany(targetEntity: Soiree::class, mappedBy: 'jeu')]
    private Collection $soirees;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'jeux')]
    #[ORM\JoinTable(name:'jeu_categorie')] 
    private Collection $categories;


    public function __construct()
    {
        $this->soirees = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNbJoueurs(): ?string
    {
        return $this->nbJoueurs;
    }

    public function setNbJoueurs(string $nbJoueurs): static
    {
        $this->nbJoueurs = $nbJoueurs;

        return $this;
    }

    public function getDureeMoyenne(): ?string
    {
        return $this->dureeMoyenne;
    }

    public function setDureeMoyenne(string $dureeMoyenne): static
    {
        $this->dureeMoyenne = $dureeMoyenne;

        return $this;
    }

    public function getAgeMinimum(): ?string
    {
        return $this->ageMinimum;
    }
    public function setAgeMinimum(string $ageMinimum): static
    {
        $this->ageMinimum = $ageMinimum;

        return $this;
    }

    /**
     * @return Collection<int, Soiree>
     */
    public function getSoirees(): Collection
    {
        return $this->soirees;
    }

    public function addSoiree(Soiree $soiree): static
    {
        if (!$this->soirees->contains($soiree)) {
            $this->soirees->add($soiree);
            $soiree->setJeu($this);
        }

        return $this;
    }

    public function removeSoiree(Soiree $soiree): static
    {
        if ($this->soirees->removeElement($soiree)) {
            // set the owning side to null (unless already changed)
            if ($soiree->getJeu() === $this) {
                $soiree->setJeu(null);
            }
        }

        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    // public function setCategories(?Categorie $categories): static
    // {
    //     $this->categories = $categories;

    //     return $this;
    // }

    public function addCategorie(Categorie $categorie): static
    {
        if (!$this->categories->contains($categorie)) {
            $this->categories->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): static
    {
        $this->categories->removeElement($categorie);

        return $this;
    }
}

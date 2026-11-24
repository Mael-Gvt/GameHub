<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: false, unique: true)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Jeu>
     */
    #[ORM\ManyToMany(targetEntity: Jeu::class, mappedBy: 'categorie')]
    private Collection $jeu;


    public function __construct()
    {
        $this->jeu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Jeu>
     */
    public function getJeus(): Collection
    {
        return $this->jeu;
    }

    public function addJeu(Jeu $jeu): static
    {
        if (!$this->jeus->contains($jeu)) {
            $this->jeus->add($jeu);
            $jeu->setCategorie($this);
        }

        return $this;
    }

    public function removeJeu(Jeu $jeu): static
    {
        if ($this->jeus->removeElement($jeu)) {
            // set the owning side to null (unless already changed)
            if ($jeu->getCategorie() === $this) {
                $jeu->setCategorie(null);
            }
        }

        return $this;
    }
}

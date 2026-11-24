<?php

namespace App\Entity;

use App\Repository\SoireeRepository;
use BcMath\Number;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoireeRepository::class)]
class Soiree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: false)]
    private ?\DateTimeImmutable $dateSoiree = null;

    #[ORM\Column(type: Types::NUMBER, precision: 10, scale: 0, nullable: false)]
    private ?Number $nbMaxParticipants = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'soiree')]
    private Collection $reservations;

    #[ORM\ManyToOne(inversedBy: 'soirees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Jeu $jeu = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSoiree(): ?\DateTimeImmutable
    {
        return $this->dateSoiree;
    }

    public function setDateSoiree(\DateTimeImmutable $dateSoiree): static
    {
        $this->dateSoiree = $dateSoiree;

        return $this;
    }

    public function getNbMaxParticipants(): ?Number
    {
        return $this->nbMaxParticipants;
    }

    public function setNbMaxParticipants(Number $nbMaxParticipants): static
    {
        $this->nbMaxParticipants = $nbMaxParticipants;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setSoiree($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getSoiree() === $this) {
                $reservation->setSoiree(null);
            }
        }

        return $this;
    }

    public function getJeu(): ?Jeu
    {
        return $this->jeu;
    }

    public function setJeu(?Jeu $jeu): static
    {
        $this->jeu = $jeu;

        return $this;
    }
}

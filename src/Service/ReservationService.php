<?php
namespace App\Service;

use App\Entity\Reservation;
use App\Entity\Soiree;
use App\Entity\Utilisateur;
use App\Repository\ReservationRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    public function __construct(
        private ReservationRepository $reservationRepository,
        private EntityManagerInterface $em,
    ) {
    }

    public function reserverSoiree(Utilisateur $utilisateur, Soiree $soiree): Reservation
    {
        $reservationExistante = $this->reservationRepository->findOneBy([
            'utilisateur' => $utilisateur,
            'soiree' => $soiree,
        ]);
        if ($reservationExistante) {
            throw new \RuntimeException('Vous avez déjà réservé cette soirée.');
        }

        $nombreReservations = $this->reservationRepository->count(['soiree' => $soiree]);
        if ($nombreReservations >= $soiree->getNbMaxParticipants()) {
            throw new \RuntimeException('Toutes les places pour cette soirée sont réservées.');
        }

        $reservation = new Reservation();
        $reservation->setUtilisateur($utilisateur);
        $reservation->setSoiree($soiree);
        $reservation->setDateReservation(new DateTimeImmutable());

        $utilisateur->addReservation($reservation);
        $soiree->addReservation($reservation);

        $this->em->persist($reservation);
        $this->em->flush();

        return $reservation;
    }

    public function annulerReservation(Reservation $reservation): void
    {
        $this->em->remove($reservation);
        $this->em->flush();
    }
}
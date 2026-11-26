<?php

namespace App\Controller;

use App\Entity\Soiree;
use App\Entity\Utilisateur;
use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ReservationController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/reservation', name: 'app_reservation_index', methods: ['GET'])]
    public function index(): Response
    {
        $utilisateur = $this->getUser();
        if (!$utilisateur instanceof Utilisateur) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('reservation/reservation.html.twig', [
            'reservations' => $utilisateur->getReservations(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/soiree/{id}/reserver', name: 'app_reservation', methods: ['POST'])]
    public function reserver(Request $request, Soiree $soiree, ReservationService $reservationService): Response
    {
        if (!$this->isCsrfTokenValid(
            'reserver_' . $soiree->getId(),
            $request->request->get('_token')
        )) {
            $this->addFlash('error', 'Jeton de sécurité invalide');

            return $this->redirectToRoute('app_soirees');
        }

        $utilisateur = $this->getUser();
        if (!$utilisateur instanceof Utilisateur) {
            throw $this->createAccessDeniedException();
        }

        try {
            $reservationService->reserverSoiree($utilisateur, $soiree);
            $this->addFlash('success', 'Réservation confirmée.');
        } catch (\RuntimeException $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        return $this->redirectToRoute('app_soirees');
    }
}

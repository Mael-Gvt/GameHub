<?php

namespace App\Controller;

use App\Repository\SoireeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SoireeController extends AbstractController
{
    #[Route('/soirees', name: 'app_soirees')]
    public function index(SoireeRepository $soireeRepository): Response
    {
        //récuperer toutes les oeuvres de la database
        $soirees = $soireeRepository->findAll();

        return $this->render('soiree/soiree.html.twig', [
            'soirees' => $soirees,
        ]);
    }
}

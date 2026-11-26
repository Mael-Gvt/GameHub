<?php

namespace App\Controller;

use App\Repository\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JeuController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(JeuRepository $jeuRepository): Response
    {
        //récuperer toutes les oeuvres de la database
        $jeux = $jeuRepository->findAll();

        return $this->render('jeu/jeu.html.twig', [
            'jeux' => $jeux,
        ]);
    }
}

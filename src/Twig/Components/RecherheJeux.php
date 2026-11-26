<?php

namespace App\Twig\Components;

use App\Repository\JeuRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent]
final class RecherheJeux
{
    use DefaultActionTrait;

    #[LiveProp(writable: true, url: true)]
    public string $nom = '';

    public function __construct(
        private JeuRepository $jeuRepository,
    ) {
    }

    #[ExposeInTemplate]
    public function getJeux(): array
    {
        if ($this->nom === '') {
            return $this->jeuRepository->findAll();
        }

        return $this->jeuRepository->rechercheParTitre($this->nom);
    }
}

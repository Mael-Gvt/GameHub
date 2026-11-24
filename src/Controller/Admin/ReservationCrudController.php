<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Entity\Soiree;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('dateReservation')->setLabel('Date de réservation'),
            AssociationField::new('utilisateur')
                ->setLabel('Utilisateur')
                ->setFormTypeOption('choice_label', static fn (Utilisateur $utilisateur): string => sprintf(
                    '%s %s (%s)',
                    $utilisateur->getPrenom(),
                    $utilisateur->getNom(),
                    $utilisateur->getEmail(),
                )),
            AssociationField::new('soiree')
                ->setLabel('Soirée')
                ->setFormTypeOption('choice_label', static fn (Soiree $soiree): string => sprintf(
                    'Soirée du %s (#%s)',
                    $soiree->getDateSoiree()?->format('d/m/Y') ?? 'date inconnue',
                    $soiree->getId() ?? 'nouvelle',
                )),
        ];
    }
    
}

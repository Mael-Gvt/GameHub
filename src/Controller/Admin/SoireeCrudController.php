<?php

namespace App\Controller\Admin;

use App\Entity\Jeu;
use App\Entity\Soiree;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class SoireeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Soiree::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('dateSoiree')->setLabel('Date de la soirée'),
            NumberField::new('nbMaxParticipants')
                ->setLabel('Nombre maximal de participants')
                ->setNumDecimals(0),
            AssociationField::new('jeu')
                ->setLabel('Jeu')
                ->setFormTypeOption('choice_label', static fn (Jeu $jeu): string => $jeu->getTitre()
                    ?? sprintf('Jeu #%s', $jeu->getId() ?? 'nouveau')),
        ];
    }
    
}

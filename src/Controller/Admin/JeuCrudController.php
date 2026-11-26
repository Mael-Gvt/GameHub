<?php

namespace App\Controller\Admin;

use App\Entity\Jeu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JeuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Jeu::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre')->setLabel('Titre'),
            TextEditorField::new('description')->setLabel('Description'),
            TextField::new('nbJoueurs')->setLabel('Nombre de joueurs'),
            TextField::new('dureeMoyenne')->setLabel('Durée moyenne'),
            TextField::new('ageMinimum')->setLabel('Âge minimum'),
            AssociationField::new('categories')->setLabel('Catégories'),
        ];
    }
    
}

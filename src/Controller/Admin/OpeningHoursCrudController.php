<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class OpeningHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHours::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('day', 'Jour de la semaine'),
            TimeField::new('lunch_opening','Horaire d\'ouverture midi'),
            TimeField::new('lunch_closing','Horaire de fermeture midi'),
            TimeField::new('dinner_opening','Horaire d\'ouverture soir'),
            TimeField::new('dinner_closing','Horaire de fermeture soir')
        ];
    }
}

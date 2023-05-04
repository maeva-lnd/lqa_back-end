<?php

namespace App\Controller\Admin;

use App\Entity\DishesCard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DishesCardCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DishesCard::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('category', 'Catégorie'),
            TextField::new('name', 'Nom du plat'),
            TextareaField::new('description', 'Description du plat'),
            MoneyField::new('price', 'Prix du plat')
                ->setCurrency('EUR')
                ->setStoredAsCents(0)
        ];
    }

}

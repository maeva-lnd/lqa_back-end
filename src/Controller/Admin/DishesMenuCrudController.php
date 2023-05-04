<?php

namespace App\Controller\Admin;

use App\Entity\DishesMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DishesMenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DishesMenu::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('menu', 'Nom du menu'),
            AssociationField::new('category', 'Catégorie'),
            TextField::new('name', 'Nom du menu'),
            TextareaField::new('description', 'Description du menu')
        ];
    }

}

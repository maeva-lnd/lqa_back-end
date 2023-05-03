<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GalleryCrudController extends AbstractCrudController
{
    public const GALLERY_BASE_PATH = 'upload/images/gallery';
    public const GALLERY_UPLOAD_DIR = 'public/upload/images/gallery';


    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('src', 'Image')
                ->setBasePath(self::GALLERY_BASE_PATH)
                ->setUploadDir(self::GALLERY_UPLOAD_DIR),
            TextField::new('title', 'Titre'),
        ];
    }
}

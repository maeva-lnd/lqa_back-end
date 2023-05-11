<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
            DateTimeField::new('arrival', 'Date avec heure d\'arrivée'),
            DateTimeField::new('departure', 'Date avec heure de départ')->hideOnForm(),
            IntegerField::new('guestNumber', 'Nombre de convives'),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom de famille'),
            TelephoneField::new('phone', 'Numéro de téléphone'),
            EmailField::new('email', 'Email'),
            TextareaField::new('allergy', 'Allergie(s) etc'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        if (!$entityInstance instanceof Reservation) return;

        $departure = new \DateTime();
        $departure->setTimestamp((int) $entityInstance->getArrival()->getTimestamp());
        $departure->add(new \DateInterval('PT90M'));
        $entityInstance->setDeparture($departure);

        parent::persistEntity($entityManager, $entityInstance);
    }

}

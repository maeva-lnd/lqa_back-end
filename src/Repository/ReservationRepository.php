<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function save(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByTimeSlot($date)
    {
        $arrival = new \DateTime();
        $arrival->setTimestamp((int) $date->getTimestamp());
        $departure = new \DateTime();
        $departure->setTimestamp((int) $date->getTimestamp());
        $departure->modify('+90 minutes');


        return $this->createQueryBuilder('r')
            ->select('sum(r.guestNumber)')
            ->orWhere('r.arrival <= :arrival AND r.arrival >= :departure')
            ->orWhere('r.departure >= :arrival AND r.departure >= :arrival')
            ->setParameter('arrival', $arrival)
            ->setParameter('departure', $departure)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}

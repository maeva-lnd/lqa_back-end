<?php

namespace App\Repository;

use App\Entity\DayLabel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DayLabel>
 *
 * @method DayLabel|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayLabel|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayLabel[]    findAll()
 * @method DayLabel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayLabelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DayLabel::class);
    }

    public function save(DayLabel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DayLabel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}

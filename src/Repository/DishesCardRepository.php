<?php

namespace App\Repository;

use App\Entity\DishesCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DishesCard>
 *
 * @method DishesCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method DishesCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method DishesCard[]    findAll()
 * @method DishesCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishesCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DishesCard::class);
    }

    public function save(DishesCard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DishesCard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}

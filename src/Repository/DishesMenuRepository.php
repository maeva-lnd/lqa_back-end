<?php

namespace App\Repository;

use App\Entity\DishesMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DishesMenu>
 *
 * @method DishesMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method DishesMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method DishesMenu[]    findAll()
 * @method DishesMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishesMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DishesMenu::class);
    }

    public function save(DishesMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DishesMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}

<?php

namespace App\Repository;

use App\Entity\Menu;
use App\Entity\MenuCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MenuCategory>
 *
 * @method MenuCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuCategory[]    findAll()
 * @method MenuCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuCategory::class);
    }

    public function save(MenuCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MenuCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return MenuCategory[] Returns an array of MenuCategory objects
     */
    public function findByMenu(Menu $menu): array
    {
        return $this->createQueryBuilder('mc')
            ->select('mc')
            ->join('mc.dishesMenus', 'md')
            ->where('md.menu = :menuId')
            ->setParameter('menuId', $menu->getId())
            ->orderBy('mc.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}

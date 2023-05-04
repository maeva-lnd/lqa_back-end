<?php

namespace App\Repository;

use App\Entity\CardCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CardCategory>
 *
 * @method CardCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardCategory[]    findAll()
 * @method CardCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardCategory::class);
    }

    public function save(CardCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CardCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}

<?php

namespace App\Repository;

use App\Entity\CoverImg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoverImg|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoverImg|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoverImg[]    findAll()
 * @method CoverImg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoverImgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoverImg::class);
    }

    // /**
    //  * @return CoverImg[] Returns an array of CoverImg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoverImg
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

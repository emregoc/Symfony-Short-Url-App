<?php

namespace App\Repository;

use App\Entity\UrlStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UrlStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlStats[]    findAll()
 * @method UrlStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlStats::class);
    }

    // /**
    //  * @return UrlStats[] Returns an array of UrlStats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UrlStats
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

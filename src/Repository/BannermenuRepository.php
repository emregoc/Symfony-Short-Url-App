<?php

namespace App\Repository;

use App\Entity\Bannermenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bannermenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bannermenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bannermenu[]    findAll()
 * @method Bannermenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BannermenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bannermenu::class);
    }

    // /**
    //  * @return Bannermenu[] Returns an array of Bannermenu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bannermenu
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

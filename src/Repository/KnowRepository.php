<?php

namespace App\Repository;

use App\Entity\Know;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Know|null find($id, $lockMode = null, $lockVersion = null)
 * @method Know|null findOneBy(array $criteria, array $orderBy = null)
 * @method Know[]    findAll()
 * @method Know[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KnowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Know::class);
    }

    // /**
    //  * @return Know[] Returns an array of Know objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Know
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

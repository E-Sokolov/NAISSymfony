<?php

namespace App\Repository;

use App\Entity\Gauth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Gauth|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gauth|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gauth[]    findAll()
 * @method Gauth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GauthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gauth::class);
    }

    // /**
    //  * @return Gauth[] Returns an array of Gauth objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gauth
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

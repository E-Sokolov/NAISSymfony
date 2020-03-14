<?php

namespace App\Repository;

use App\Entity\MailNotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MailNotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailNotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailNotes[]    findAll()
 * @method MailNotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailNotesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailNotes::class);
    }

    // /**
    //  * @return MailNotes[] Returns an array of MailNotes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MailNotes
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

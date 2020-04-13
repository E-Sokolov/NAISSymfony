<?php

namespace App\Repository;

use App\Entity\Calls;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Calls|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calls|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calls[]    findAll()
 * @method Calls[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Calls[]    getFilteredCalls(array $filter)
 */
class CallsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calls::class);
    }
    public function getFilteredCalls(array $filter){
        $q = $this -> createQueryBuilder('calls');
        if(!empty($filter['date']))
        {
            $dateArr = explode('//',$filter['date']);
            $dateFrom = $dateArr[0];
            $dateTo = $dateArr[1];
            $q ->andWhere('calls.date BETWEEN \''.$dateFrom.'\' AND \''.$dateTo.'\'');
        }
        if(!empty($filter['clientType']))
        {
            $q -> andWhere('calls.client_type = \''.$filter['clientType'].'\'');
        }
        if(!empty($filter['client']))
        {
            $q -> andWhere('calls.client LIKE \'%'.$filter['client'].'%\'');
        }
        if(!empty($filter['fio']))
        {
            $q -> andWhere('calls.fio LIKE \'%'.$filter['fio'].'%\'');
        }
        if(!empty($filter['resource']))
        {
            $q -> andWhere('calls.resource = \''.$filter['resource'].'\'');
        }
        if(!empty($filter['description']))
        {
            $q -> andWhere('calls.description LIKE \'%'.$filter['description'].'%\'');
        }
        if(!empty($filter['what_to_do']))
        {
            $q -> andWhere('calls.what_to_do LIKE \'%'.$filter['what_to_do'].'%\'');
        }
        if(!empty($filter['ingeneer']))
        {
            $q -> andWhere('calls.ingeneer = \''.$filter['ingeneer'].'\'');
        }
        if(!empty($filter['etc_data']))
        {
            $q -> andWhere('calls.etc_data LIKE \'%'.$filter['etc_data'].'%\'');
        }
        if(!empty($filter['status']))
        {
            $q -> andWhere('calls.status = \''.$filter['status'].'\'');
        }
        return $q->getQuery()->getResult();
    }
    // /**
    //  * @return Calls[] Returns an array of Calls objects
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
    public function findOneBySomeField($value): ?Calls
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

<?php

namespace App\Repository;

use App\Entity\Reservation1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation1[]    findAll()
 * @method Reservation1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Reservation1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation1::class);
    }

    // /**
    //  * @return Reservation1[] Returns an array of Reservation1 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservation1
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getLastid()
{
    $qb = $this->createQueryBuilder('v')
    ->select('max(v.id) AS maxid');
    
 return $qb->getQuery()
    ->getResult();

}
}

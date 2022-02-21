<?php

namespace App\Repository;

use App\Entity\Offrevoyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offrevoyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offrevoyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offrevoyage[]    findAll()
 * @method Offrevoyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffrevoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offrevoyage::class);
    }

    // /**
    //  * @return Offrevoyage[] Returns an array of Offrevoyage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offrevoyage
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

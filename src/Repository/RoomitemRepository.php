<?php

namespace App\Repository;

use App\Entity\Roomitem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Roomitem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Roomitem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Roomitem[]    findAll()
 * @method Roomitem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomitemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Roomitem::class);
    }

    // /**
    //  * @return Roomitem[] Returns an array of Roomitem objects
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
    public function findOneBySomeField($value): ?Roomitem
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

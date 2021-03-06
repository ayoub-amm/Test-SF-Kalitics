<?php

namespace App\Repository;

use App\Entity\Pointages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pointages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointages[]    findAll()
 * @method Pointages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointages::class);
    }

    // /**
    //  * @return Pointages[] Returns an array of Pointages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pointages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function getDureeByuserInWeek($user, $start_week, $end_week): ?int
    {
        return $this->createQueryBuilder('p')
            ->select('sum(p.duree)')
            ->leftJoin('p.utilisateur','u')
            ->andWhere('u.id = :id')
            ->setParameter(':id', $user)
            ->andWhere('p.date BETWEEN :monday AND :sunday')
            ->setParameter('monday', $start_week)
            ->setParameter('sunday', $end_week)
            ->getQuery()
            ->getOneOrNullResult()[1]
        ;
    }

    public function getAllPointages()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
        ;
    }
    
}

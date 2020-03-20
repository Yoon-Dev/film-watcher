<?php

namespace App\Repository;

use App\Entity\SousTitre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SousTitre|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousTitre|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousTitre[]    findAll()
 * @method SousTitre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousTitreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousTitre::class);
    }

    // /**
    //  * @return SousTitre[] Returns an array of SousTitre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SousTitre
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

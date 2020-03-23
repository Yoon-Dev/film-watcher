<?php

namespace App\Repository;

use App\Entity\Video;
use App\Entity\VideoSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * @return Video[] Returns an array of User objects
     */
    public function findByQuery(VideoSearch $videosearch)
    {
        $q = $this->createQueryBuilder('u')
            ->where('u.type = :val')
            ->setParameter('val', 'film');
            if($videosearch->getNom()){
                dump('oui');
                $q = $q->where('u.type = :val')
                  ->andWhere('u.nom = :nom')
                  ->setParameter('val', 'film')
                  ->setParameter('nom', $videosearch->getNom()); 
            }
            // add test for tag class !!
        $q = $q->getQuery()
        ->getResult();
        return $q;
    }
    
}

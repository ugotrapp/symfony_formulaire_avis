<?php

namespace App\Repository;

use App\Entity\Opinion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Opinion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opinion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opinion[]    findAll()
 * @method Opinion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpinionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Opinion::class);
    }

    // /**
    //  * @return Opinion[] Returns an array of Avis objects
    //  */
    
    public function findByDate()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.date_de_creation', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByNote()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.note', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return array
     */
    public function getNoteRank(int $value): array
    {
        $queryBuilder = $this->createQueryBuilder('o')->select(['o.note']);

        return array_column($queryBuilder->getQuery()->getArrayResult(), 'note');
    }

    /**
     * @return array
     */
    public function getDate(int $value): array
    {
        $queryBuilder = $this->createQueryBuilder('o')->select(['o.dateDeCreation']);

        return array_column($queryBuilder->getQuery()->getArrayResult(), 'dateDeCreation');
    }

    

    
    public function getRatingStars($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.note = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
}

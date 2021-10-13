<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    

    public function findPlateform($value)
    {
        $qb = $this->createQueryBuilder('g');

        
            $qb->andWhere('g.plateform like :plateform');
            $qb->setParameter('plateform', "%{$value}%");
    
            return $qb->getQuery()->getResult();
    }

    public function test($id)
    {
        $qb = $this->createQueryBuilder('g');
        $qb->innerJoin('g.opinion', 'o');
        $qb->andWhere('o.id = :id');
        $qb->setParameter('id',"{$id}" );

        // dd($qb->getQuery());
            return $qb->getQuery()->getResult();
    }

   
}

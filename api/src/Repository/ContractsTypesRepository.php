<?php

namespace App\Repository;

use App\Entity\ContractsTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContractsTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractsTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractsTypes[]    findAll()
 * @method ContractsTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractsTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractsTypes::class);
    }

    // /**
    //  * @return ContractsTypes[] Returns an array of ContractsTypes objects
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
    public function findOneBySomeField($value): ?ContractsTypes
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

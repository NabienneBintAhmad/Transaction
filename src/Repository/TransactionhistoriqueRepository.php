<?php

namespace App\Repository;

use App\Entity\Transactionhistorique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Transactionhistorique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transactionhistorique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transactionhistorique[]    findAll()
 * @method Transactionhistorique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionhistoriqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Transactionhistorique::class);
    }

    // /**
    //  * @return Transactionhistorique[] Returns an array of Transactionhistorique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Transactionhistorique
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    // /**
    //  * @return Transaction[] Returns an array of Transaction objects
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

    
    public function findOneBycode($value): ?Transaction
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.code = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
   /**
    * @param $debut
    * @param $fin
    * @param $user
    * @return Operations[] Returns an array of Operations objects
    */
    public function findByPeriode($debut,$fin,$user): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.date >= :debut' )
            ->andWhere('p.date <= :fin ' )
            ->addSelect('r')
            ->leftJoin('p.multiservice','r')
            ->andWhere('r.id =:val')
            ->setParameter('debut', $debut->format('Y-m-d') . ' 00:00:00')
            ->setParameter('fin', $fin->format('Y-m-d') . ' 23:59:59')
            ->setParameter('val', $user)
            ->getQuery();
        return $qb->execute();
    }

  /**
    * @param $debut
    * @param $fin
    * @param $user
    * @return Operations[] Returns an array of Operations objects
    */
    public function findByPeriodeAdmin($debut,$fin,$user): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.date >= :debut' )
            ->andWhere('p.date <= :fin ' )
            ->addSelect('r')
            ->leftJoin('p.adminEnv','r')
            ->andWhere('r.id =:val')
            ->setParameter('debut', $debut->format('Y-m-d') . ' 00:00:00')
            ->setParameter('fin', $fin->format('Y-m-d') . ' 23:59:59')
            ->setParameter('val', $user)
            ->getQuery();
        return $qb->execute();
    }



  /**
    * @param $debut
    * @param $fin
    * @param $user
    * @return Operations[] Returns an array of Operations objects
    */
    public function findByPeriodeRetrait($debut,$fin,$user): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.dateRetrait >= :debut' )
            ->andWhere('p.dateRetrait <= :fin ' )
            ->addSelect('r')
            ->leftJoin('p.serviceRetrait','r')
            ->andWhere('r.id =:val')
            ->setParameter('debut', $debut->format('Y-m-d') . ' 00:00:00')
            ->setParameter('fin', $fin->format('Y-m-d') . ' 23:59:59')
            ->setParameter('val', $user)
            ->getQuery();
        return $qb->execute();
    }

    /**
    * @param $debut
    * @param $fin
    * @param $user
    * @return Operations[] Returns an array of Operations objects
    */
    public function findByPeriodeRetraitAdmin($debut,$fin,$user): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.dateRetrait >= :debut' )
            ->andWhere('p.dateRetrait <= :fin ' )
            ->addSelect('r')
            ->leftJoin('p.adminRet','r')
            ->andWhere('r.id =:val')
            ->setParameter('debut', $debut->format('Y-m-d') . ' 00:00:00')
            ->setParameter('fin', $fin->format('Y-m-d') . ' 23:59:59')
            ->setParameter('val', $user)
            ->getQuery();
        return $qb->execute();
    }

}

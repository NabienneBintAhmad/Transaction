<?php

namespace App\Repository;

use App\Entity\UserPrestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserPrestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPrestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPrestataire[]    findAll()
 * @method UserPrestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserPrestataireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserPrestataire::class);
    }

    // /**
    //  * @return UserPrestataire[] Returns an array of UserPrestataire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserPrestataire
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

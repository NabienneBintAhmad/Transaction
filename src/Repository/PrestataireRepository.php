<?php

namespace App\Repository;

use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Prestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataire[]    findAll()
 * @method Prestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }

    // /**
    //  * @return Prestataire[] Returns an array of Prestataire objects
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

    
    public function findOneBymatricule($value): ?Prestataire
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.matricule = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
   
}

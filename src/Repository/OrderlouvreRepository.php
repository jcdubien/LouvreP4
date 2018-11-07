<?php

namespace App\Repository;

use App\Entity\Orderlouvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Orderlouvre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orderlouvre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orderlouvre[]    findAll()
 * @method Orderlouvre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderlouvreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Orderlouvre::class);
    }

//    /**
//     * @return Orderlouvre[] Returns an array of Orderlouvre objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Orderlouvre
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

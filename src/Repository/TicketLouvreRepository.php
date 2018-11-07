<?php

namespace App\Repository;

use App\Entity\TicketLouvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TicketLouvre|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketLouvre|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketLouvre[]    findAll()
 * @method TicketLouvre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketLouvreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketLouvre::class);
    }

//    /**
//     * @return TicketLouvre[] Returns an array of TicketLouvre objects
//     */
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
    public function findOneBySomeField($value): ?TicketLouvre
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

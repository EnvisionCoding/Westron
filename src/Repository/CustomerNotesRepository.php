<?php

namespace App\Repository;

use App\Entity\CustomerNotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomerNotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerNotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerNotes[]    findAll()
 * @method CustomerNotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerNotesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerNotes::class);
    }

    // /**
    //  * @return CustomerNotes[] Returns an array of CustomerNotes objects
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
    public function findOneBySomeField($value): ?CustomerNotes
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

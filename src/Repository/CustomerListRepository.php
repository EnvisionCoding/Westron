<?php

namespace App\Repository;

use App\Entity\CustomerList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\ErrorHandler\Debug;

/**
 * @method CustomerList|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerList|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerList[]    findAll()
 * @method CustomerList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerList::class);
    }

    /**
     * Fetches all customers or returns null if connection to database fails
     * @return array|null
     */
    public function fetchAllCustomers()
    {
        $connection = $this->getEntityManager()->getConnection();

        try {
            $stmt = $connection->prepare("
                SELECT * 
                FROM customer_list
            ");

            $stmt->execute();

            $results = $stmt->fetchAllAssociative();

        } catch (Exception $e) {
            echo 'Exception caught '. $e;
        } catch (\Doctrine\DBAL\Driver\Exception $e) {
            echo 'Exception caught '. $e;
        }

        return $results ?? null;
    }
}

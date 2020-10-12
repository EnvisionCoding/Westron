<?php

namespace App\Repository;

use App\Entity\CustomerNotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
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

    /**
     * Fetches the specific customer's note or returns null if connection to the database fails
     * @param int $id       - id of the specific customer
     * @return array|null
     */
    public function fetchCustomerNotes(int $id)
    {
        $connection = $this->getEntityManager()->getConnection();

        try {
            $stmt = $connection->prepare("
                SELECT notes 
                FROM customer_notes
                WHERE customer_list_id = :id
            ");

            $stmt->execute(['id' => $id]);

            $results = $stmt->fetchAllAssociative();

        } catch (Exception $e) {
            echo 'Exception caught '. $e;
        } catch (\Doctrine\DBAL\Driver\Exception $e) {
            echo 'Exception caught '. $e;
        }

        return $results ?? null;
    }
}

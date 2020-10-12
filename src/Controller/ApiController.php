<?php

namespace App\Controller;

use App\Repository\CustomerListRepository;
use App\Repository\CustomerNotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/customers", name="api_customers")
     * @param CustomerListRepository $customerListRepository
     * @param CustomerNotesRepository $customerNotesRepository
     * @return JsonResponse
     */
    public function index(CustomerListRepository $customerListRepository, CustomerNotesRepository $customerNotesRepository)
    {
        $customers = $customerListRepository->fetchAllCustomers();

        $compiledCustomers = [];

        foreach ($customers as $customer) {
            $currentCustomer = $customer['id'];

            $currentCustomerNotes = $customerNotesRepository->fetchCustomerNotes($currentCustomer)[0]['notes'];

            $compiledCustomers[] =
                [
                    'id' => $customer['id'],
                    'first_name' => $customer['first_name'],
                    'last_name' => $customer['last_name'],
                    'notes' => $currentCustomerNotes,
                ];
        }

        $totalRows = count($compiledCustomers);

        $json_array = [
            'total:' => $totalRows,
            'rows:' => $compiledCustomers,
        ];

        $jsonCustomers = json_encode($json_array);

        return new JsonResponse($jsonCustomers);
    }
}
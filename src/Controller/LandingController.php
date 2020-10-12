<?php

namespace App\Controller;

use App\Entity\CustomerList;
use App\Repository\CustomerListRepository;
use App\Repository\CustomerNotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param CustomerListRepository $customerListRepository
     * @param CustomerNotesRepository $customerNotesRepository
     * @return Response
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

        return $this->render('pages/landing.html.twig',
            ['customers' => $compiledCustomers]
        );
    }
}
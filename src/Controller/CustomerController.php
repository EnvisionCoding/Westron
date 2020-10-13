<?php

namespace App\Controller;

use App\Entity\CustomerList;
use App\Entity\CustomerNotes;
use App\Form\Type\CustomerType;
use App\Repository\CustomerListRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/forms/new-customer", name="form_new_customer")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newCustomer(EntityManagerInterface $entityManager, Request $request)
    {
        $customerList = new CustomerList();
        $customerNotes = new CustomerNotes();

        $form = $this->createForm(CustomerType::class, $customerList);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $customerList->setFirstName($data['first_name']);
            $customerList->setLastName($data['last_name']);
            $customerNotes->setNotes($data['notes']);

            $this->addFlash('success', 'Record added successfully.');


            $entityManager->persist($customerList);
            $entityManager->persist($customerNotes);
            $entityManager->flush();


            return $this->redirectToRoute('app_home');
        }

        return $this->render('forms/newCustomer.html.twig', [
            'listForm' => $form->createView(),
        ]);
    }
}
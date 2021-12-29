<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customers', name : 'customer_index')]
    public function customerIndex () {
        $Customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        return $this->render("customer/index.html.twig",
        [
            'customers' => $customers
        ]);
    }

    #[Route('/customer/detail/{id}', name : 'customer_detail')]
    public function customerDetail ($id) {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        if ($customer == null) {
            $this->addFlash("Error", "Customer not existed");
            return $this->redirectToRoute("customer_index");
        } 
        return $this->render("customer/detail.html.twig",
        [
            'customer' => $customer
        ]);
    }

    #[Route('/customer/delete/{id}', name : 'customer_delete')]
    public function customerDelete ($id) {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        if ($customer == null) {
            $this->addFlash("Error", "Customer delete failed");
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($customer);
            $manager->flush();
            $this->addFlash("Success", "Customer delete succeed");
        }
        return $this->redirectToRoute('customer_index');
    }
    
    #[Route('/customer/add', name : 'customer_add')]
    public function customerAdd (Request $request) {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class,$customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($Customer);
            $manager->flush();

            $this->addFlash("Success", "Add Customer succeed");
            return $this->redirectToRoute("customer_index");
        }

        return $this->renderForm("customer/add.html.twig",
        [
            'customerForm' => $form
        ]);
    }

    #[Route('/customer/edit/{id}', name : 'customer_edit')]
    public function customerEdit (Request $request, $id) {
        $Customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        $form = $this->createForm(CustomerType::class,$Customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($customer);
            $manager->flush();

            $this->addFlash("Scccess", "Edit Customer succeed");
            return $this->redirectToRoute("customer_index");
        }

        return $this->renderForm("customer/edit.html.twig",
        [
            'customerForm' => $form
        ]);
    }
}


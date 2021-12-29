<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employees', name : 'employee_index')]
    public function employeeIndex () {
        $employees = $this->getDoctrine()->getRepository(Employee::class)->findAll();
        return $this->render("employee/index.html.twig",
        [
            'employees' => $employees
        ]);
    }

    #[Route('/employee/detail/{id}', name : 'employee_detail')]
    public function employeeDetail ($id) {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        if ($employee == null) {
            $this->addFlash("Error", "Employee not existed");
            return $this->redirectToRoute("employee_index");
        } 
        return $this->render("employee/detail.html.twig",
        [
            'employee' => $employee
        ]);
    }

    #[Route('/employee/delete/{id}', name : 'employee_delete')]
    public function employeeDelete ($id) {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        if ($employee == null) {
            $this->addFlash("Error", "Employee delete failed");
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($employee);
            $manager->flush();
            $this->addFlash("Success", "Employee delete succeed");
        }
        return $this->redirectToRoute('employee_index');
    }
    
    #[Route('/employee/add', name : 'employee_add')]
    public function employeeAdd (Request $request) {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class,$employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($Employee);
            $manager->flush();

            $this->addFlash("Success", "Add Employee succeed");
            return $this->redirectToRoute("employee_index");
        }

        return $this->renderForm("employee/add.html.twig",
        [
            'employeeForm' => $form
        ]);
    }

    #[Route('/employee/edit/{id}', name : 'employee_edit')]
    public function employeeEdit (Request $request, $id) {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        $form = $this->createForm(EmployeeType::class,$Employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($employee);
            $manager->flush();

            $this->addFlash("Scccess", "Edit Employee succeed");
            return $this->redirectToRoute("employee_index");
        }

        return $this->renderForm("employee/edit.html.twig",
        [
            'employeeForm' => $form
        ]);
    }
}


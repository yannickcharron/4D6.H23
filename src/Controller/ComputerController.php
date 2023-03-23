<?php

namespace App\Controller;

use App\Core\Notification;
use App\Core\NotificationColor;
use App\Entity\Computer;
use App\Form\ComputerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ComputerController extends AbstractController
{
    #[Route('/computer', name: 'app_computer')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $computers = $entityManager->getRepository(Computer::class)->findAll();

        return $this->render('computer/index.html.twig', [
            'computers' => $computers
        ]);
    }

    #[Route('/computer/update/{idComputer}', name: 'computer_update')]
    public function update($idComputer, Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $computer = $entityManager->getRepository(Computer::class)->find($idComputer);

        $form = $this->createForm(ComputerType::class, $computer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->getRepository(Computer::class)->save($computer, true);
            $this->addFlash('computer', new Notification('success', 'Ordinateur sauvergardé', NotificationColor::INFO));
            return $this->redirectToRoute('app_computer');
        }

        return $this->render('computer/builder.html.twig', [
            'computer_form' => $form
        ]);
    }


    #[Route('/computer/builder', name: 'app_computer_builder')]
    public function index_builder(Request $request, ManagerRegistry $doctrine) : Response {

        $computer = new Computer();
        $form = $this->createForm(ComputerType::class, $computer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            //Ajouter dans la base de données
            $entityManager = $doctrine->getManager();
            $entityManager->getRepository(Computer::class)->save($computer, true);

            //TODO: Notification
            //Redirect
            return $this->redirectToRoute('app_computer');
        }


        return $this->render('computer/builder.html.twig', [
            'computer_form' => $form
        ]);
    }
}

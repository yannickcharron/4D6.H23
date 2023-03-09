<?php

namespace App\Controller;

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
    public function index(): Response
    {
        return $this->render('computer/index.html.twig');
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

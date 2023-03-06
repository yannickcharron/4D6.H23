<?php

namespace App\Controller;

use App\Entity\Computer;
use App\Form\ComputerType;
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
    public function index_builder(Request $request) : Response {

        $computer = new Computer();
        $form = $this->createForm(ComputerType::class, $computer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            //TODO: Ajouter dans la base de données
            //TODO: Notification
            //TODO: Redirect
        }


        return $this->render('computer/builder.html.twig', [
            'computer_form' => $form
        ]);
    }
}

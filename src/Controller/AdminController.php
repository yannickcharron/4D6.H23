<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

//#[IsGranted('ROLE_ADMIN', statusCode: 423)]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if(!$this->isGranted('ROLE_ADMIN')) {
            //TODO : Quoi faire si je ne suis pas admin
            //Redirect
        }

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


}

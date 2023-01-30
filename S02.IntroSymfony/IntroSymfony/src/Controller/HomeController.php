<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $dictionary = [];
        $dictionary['controller_name'] = 'HomeController';
        $dictionary['my_name'] = 'Yannick Charron';

        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        //     'my_name' => 'Yannick Charron'
        // ]);

        return $this->render('home/index.html.twig', $dictionary);
    }

    // /yannick
    #[Route('/yannick', name:'yannick.route')]
    public function yannickRoute() : Response {

        return $this->render('home/yannick.html.twig', [
            'image_name' => 'chat2',
            'image_extension' => 'webp'
        ]);
     }
}

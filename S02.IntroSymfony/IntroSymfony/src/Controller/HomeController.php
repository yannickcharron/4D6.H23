<?php

namespace App\Controller;

use App\Entity\Champion;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $em = null;

    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        //$entityManager = $doctrine->getManager(); 
        //! DANGER Ligne importante pour les fonctions utilitaires
        $this->em = $doctrine->getManager();

        //$champions = $this->retrieveAllChampions($entityManager);
       
        $champions = $this->retrieveAllChampions();

        //Pour déboguer des fois
        //var_dump($champions);

        return $this->render('home/index.html.twig', ['champions' => $champions]);
    }

    private function retrieveAllChampions() {

        return $this->em->getRepository(Champion::class)->findAll();
        
    }

    // private function retrieveAllChampions($entityManager) {

    //     return $entityManager->getRepository(Champion::class)->findAll();
        
    // }

    // /yannick
    #[Route('/yannick', name:'yannick.route')]
    public function yannickRoute() : Response {

        return $this->render('home/yannick.html.twig', [
            'image_name' => 'chat2',
            'image_extension' => 'webp'
        ]);
     }
}

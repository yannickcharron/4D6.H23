<?php

namespace App\Controller;

use App\Entity\Champion;
use App\Entity\Role;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $em = null;

    #[Route('/', name: 'app_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        //$entityManager = $doctrine->getManager(); 
        //! DANGER Ligne importante pour les fonctions utilitaires
        $this->em = $doctrine->getManager();

        $role = $request->query->get('role'); // $_GET['role']
        $searchField = $request->request->get('search_field'); // $_POST['search_field']

        $roles = $this->retrieveAllRoles();

        //$champions = $this->retrieveAllChampions($entityManager);
       
        // if($role != null) {
        //     $champions = $this->retrieveChampionFromRole($role);
        // } else {
        //     $champions = $this->retrieveAllChampions();
        // }
        
        $champions = $this->retrieveChampions($role, $searchField);
        

        //Pour déboguer des fois
        //var_dump($champions);

        return $this->render('home/index.html.twig', ['champions' => $champions, 'roles' => $roles]);
    }


    #[Route('/champions/{idChampion}', name:'champion_modal')]
    public function infoChampion($idChampion, Request $request, ManagerRegistry $doctrine): Response {
        //2 Philosophies -> JSON, HTML

        $this->em = $doctrine->getManager();

        $champion = $this->em->getRepository(Champion::class)->find($idChampion);

        return $this->render('home/champion.modal.twig', ['champion' => $champion]);

    }

    
    private function retrieveChampions($role, $searchField) {
        return $this->em->getRepository(Champion::class)->findWithCriteria($role, $searchField);
    }

    private function retrieveChampionFromRole($role) {
        return $this->em->getRepository(Role::class)->find($role)->getChampions();
    }

    private function retrieveAllRoles() 
    {
        //SQL -> SELECT * FROM roles
        return $this->em->getRepository(Role::class)->findAll();
    }

    private function retrieveAllChampions() 
    {

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

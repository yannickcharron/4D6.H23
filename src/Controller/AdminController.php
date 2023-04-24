<?php

namespace App\Controller;

use App\Entity\Item;

use App\Form\ItemCollection;
use App\Form\ItemCollectionType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;

//#[IsGranted('ROLE_ADMIN', statusCode: 423)]
class AdminController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if(!$this->isGranted('ROLE_ADMIN')) {
            //TODO : Quoi faire si je ne suis pas admin
            //Redirect
        }

        $items = $this->em->getRepository(Item::class)->findAll();
        $itemsCollection = new ItemCollection($items);

        $formItems = $this->createForm(ItemCollectionType::class, $itemsCollection);

        $formItems->handleRequest($request);

        if($formItems->isSubmitted() && $formItems->isValid()) 
        {
            // $formItems->getData() === $itemsCollection modifié
            $newCollectionItems = $formItems->getData()->getItems();

            foreach($newCollectionItems as $newItem)
            {
                $this->em->persist($newItem);
            }
            $this->em->flush();
        }



        return $this->render('admin/index.html.twig', [
            'formItems' => $formItems
        ]);
    }


}

<?php

namespace App\Controller;

use App\Core\Notification;
use App\Core\NotificationColor;
use App\Form\ProfilePictureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\String\Slugger\SluggerInterface;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;

class ProfileController extends AbstractController
{
    private $em = null;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $currentUser = $this->getUser();

        $formPicture = $this->createForm(ProfilePictureType::class);
        $formPicture->handleRequest($request);

        if($formPicture->isSubmitted() && $formPicture->isValid()) {
            
            $profilePicture = $formPicture->get('profilePicture')->getData();

            if($profilePicture) {
                $originalFilename = pathinfo($profilePicture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . "-" . uniqid() . ".". $profilePicture->guessExtension(); 

                try {
                    $profilePicture->move(
                        $this->getParameter('profile_picture_directory'),
                        $newFilename);

                    $currentUser->setProfilePicture("/images/profiles/".$newFilename);
                    $this->em->persist($currentUser);
                    $this->em->flush();

                } catch(FileException $e) {
                    //TODO: Erreur
                } catch(ORMException $e) {
                    //TODO: Erreur
                }
            }

        }

        return $this->render('profile/index.html.twig', [
            'currentUser' => $currentUser,
            'formPicture' => $formPicture
        ]);
    }

    #[Route('/login', name:'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response 
    {
        if($this->getUser()) {
            return $this->redirectToRoute('app_profile');
        }

        $notification = null;
        $error = $authenticationUtils->getLastAuthenticationError();
        if($error != null && $error->getMessageKey() === 'Invalid credentials.') {
            $message = "Mauvaise combinaison d'identifiant et de mot de passe.";
            $notification = new Notification('error', $message, NotificationColor::WARNING);
        }

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('profile/login.html.twig', [
            'last_username' => $lastUsername,
            'notification' => $notification
        ]);
    }

    #[Route('/logout', name:'app_logout')]
    public function logout() {

        throw new \Exception("Don't forget to activate logout in security.yaml");
    }
}

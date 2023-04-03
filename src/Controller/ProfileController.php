<?php

namespace App\Controller;

use App\Core\Notification;
use App\Core\NotificationColor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $currentUser = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'currentUser' => $currentUser
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

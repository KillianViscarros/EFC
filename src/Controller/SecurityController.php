<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Méthode pour gérer la connexion des utilisateurs.
     * 
     * @return Response
     */
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
       
        // Récupération de l'erreur de connexion, s'il y en a une.
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupération du dernier nom d'utilisateur saisi par l'utilisateur.
        $lastUsername = $authenticationUtils->getLastUsername();

        // Affichage de la page de connexion avec les données nécessaires.
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
             'error' => $error
            ]);
    }

    /**
     * Méthode pour gérer la déconnexion des utilisateurs.
     * 
     * Cette méthode ne doit pas contenir de logique car elle sera interceptée par le mécanisme de déconnexion de Symfony.
     */
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
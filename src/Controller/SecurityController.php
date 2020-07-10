<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        //Permet d'afficher un message d'erreur en ca sde saisie erronnée
        $error = $utils->getLastAuthenticationError();
        //Conserve l'adresse mail an cas d'erreur
        $username = $utils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se deconnecter
     *
     * @Route("/logout", name="account_logout")
     */
    public function logout()
    {
        //...géré par symfony
    }
}

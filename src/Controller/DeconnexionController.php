<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeconnexionController extends AbstractController
{
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deco( SessionInterface $session): Response
    {
        $session->remove('user');
        $this->addFlash(
            'notice',
            'Vous avez été déconnecté'
        );
        return $this->redirectToRoute('accueil');
    }
}
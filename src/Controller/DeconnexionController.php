<?php

namespace App\Controller;

use App\Services\MenusGeneral;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeconnexionController extends AbstractController
{
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deco( SessionInterface $session, MenusGeneral $menus): Response
    {
        $menu = $menus->returnMenu();
        $session->remove('user');
        $session->remove('acces');
        $session->remove('userId');
        $this->addFlash(
            'notice',
            'Vous avez été déconnecté'
        );
        return $this->redirectToRoute('accueil', ['menu' => $menu]);
    }
}
<?php

namespace App\Controller;

use App\Services\MenusGeneral;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class IndexController extends AbstractController
{
    /**
      * @Route("/", name="accueil")
      */
    public function index(SessionInterface $session, MenusGeneral $menus): Response
    {
        $menu = $menus->returnMenu();
        return $this->render('index.html.twig', ['menu' => $menu]);
    }


}
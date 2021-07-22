<?php

namespace App\Controller;

use App\Services\MenusGeneral;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Erreur403Controller extends AbstractController
{
   
    /**
     * @Route("/403" , name="403")
     */
    public function erreur(Request $request, MenusGeneral $menus): Response
    {
        $routeParameters = $request->attributes->get('_route_params');
        $menu = $menus->returnMenu();
        return $this->render('erreurs/403.html.twig', ['menu' => $menu]);
    }
}
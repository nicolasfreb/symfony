<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Erreur403Controller extends AbstractController
{
   
    /**
     * @Route("/403" , name="403")
     */
    public function erreur(Request $request): Response
    {
        $routeParameters = $request->attributes->get('_route_params');
        return $this->render('erreurs/403.html.twig');
    }
}
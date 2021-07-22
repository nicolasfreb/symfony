<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Erreur404Controller extends AbstractController
{
   
    /**
     * @Route("/{url}" , requirements={"url"=".+"}, name="404", priority=-1)
     */
    public function erreur(Request $request): Response
    {
        $routeParameters = $request->attributes->get('_route_params');
        return $this->render('erreurs/404.html.twig', ['url' => $routeParameters['url']]);
    }
}
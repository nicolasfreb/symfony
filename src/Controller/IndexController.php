<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class IndexController extends AbstractController
{
    /**
      * @Route("/", name="accueil")
      */
    public function index(SessionInterface $session): Response
    {
        $user = $session->get('user');
        return $this->render('index.html.twig');
    }
}
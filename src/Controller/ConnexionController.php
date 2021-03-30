<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/connexion", methods={"GET","HEAD"}, name="connexion")
     */
    public function connexionForm(): Response
    {
        return $this->render('connexion.html.twig');
    }

}
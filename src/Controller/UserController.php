<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{user}", methods={"GET","HEAD"}, name="user")
     */
    public function user(string $user, SessionInterface $session): Response
    {
        $session->set('user', $user);
        return $this->render('user.html.twig', ['user' => $session->get('user')]);
    }

}
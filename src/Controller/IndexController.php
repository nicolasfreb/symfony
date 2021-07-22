<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Menu;
class IndexController extends AbstractController
{
    /**
      * @Route("/", name="accueil")
      */
    public function index(SessionInterface $session): Response
    {
        $user = $session->get('user');
        $menu = SELF::setMenu();

        return $this->render('index.html.twig', ['menu' => $menu]);
    }


    public function setMenu() : Array
    {
        $menuDoctrine = $this->getDoctrine()->getRepository(Menu::class);
        $listMenu = $menuDoctrine->findAll();
        $menus = [];

        foreach ($listMenu as $menu){
            $data['titre'] = $menu->getNom();
            $data['url'] = $menu->getUrl();
            $data['acces'] = explode("|",$menu->getAcces());
            array_push($menus,$data);
        }

        return $menus;
    }
}
<?php
namespace App\Services;

use App\Entity\Menu;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MenusGeneral extends AbstractController
{
    public function returnMenu() : Array
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
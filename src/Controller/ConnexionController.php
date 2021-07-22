<?php
namespace App\Controller;

use App\Services\MenusGeneral;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Utilisateurs;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/connexion", methods={"GET","HEAD", "POST"}, name="connexion")
     */
    public function connexionForm(SessionInterface $session, MenusGeneral $menus): Response
    {
        $menu = $menus->returnMenu();
        if(empty ($_POST['email']) and empty ($_POST['password']) and empty ($_POST['login'])){
            return $this->render('connexion.html.twig', ['menu' => $menu]);
        }
        else{
            $user = $this->getDoctrine()->getRepository(Utilisateurs::class);
            $utilisateur = $user->findOneBy([
                'login' => $_POST['login'],
                'password' => md5($_POST['password'])
            ]);
            if( !$utilisateur){
                $this->addFlash(
                    'notice',
                    'Login ou mot de passe incorrect'
                ); 
                return $this->render('connexion.html.twig', ['menu' => $menu]);
            }
            else{
                $session->set('user', $utilisateur->getLogin());
                $session->set('acces', $utilisateur->getAcces());
                $session->set('userId', $utilisateur->getId());
                $this->addFlash(
                    'notice',
                    'Vous êtes maintenant connecté'
                );
                return $this->redirectToRoute('accueil', ['menu' => $menu]);
            }
        }
    }

}
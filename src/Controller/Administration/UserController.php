<?php
namespace App\Controller\Administration;

use App\Services\MenusGeneral;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Utilisateurs;

class UserController extends AbstractController
{
    /**
     * @Route("/Administration/user/{userId}", methods={"GET","HEAD", "POST"}, name="user")
     */
    public function ficheUser(int $userId, SessionInterface $session,  MenusGeneral $menus): Response
    {
        if( $session->get('acces') == 'Administrateur'){
            if(isset($_POST['userId'])){
                $entityManager = $this->getDoctrine()->getManager();
                $user = $entityManager->getRepository(Utilisateurs::class)->find($userId); 

                $user->setLogin($_POST['login']);
                $user->setEmail($_POST['email']);
                if(!empty($_POST['password']) ) $user->setPassword(md5($_POST['password']));
                $user->setAcces($_POST['acces']);

                $entityManager->flush();
                $this->addFlash(
                    'notice',
                    'L\'utilisateur '.$_POST['login'].' a bien été modifié'
                );
                return $this->redirectToRoute('users'); 
            }
            else{
                $entityManager = $this->getDoctrine()->getManager();
                $user = $entityManager->getRepository(Utilisateurs::class)->find($userId);
                $menu = $menus->returnMenu();
                return $this->render('users/user.html.twig', ['user' => $user, 'menu' => $menu]);
            }
        }
        else{
            return $this->redirectToRoute('403'); 
        }
        

    }
}
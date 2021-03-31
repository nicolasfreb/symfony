<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Utilisateurs;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{userId}", methods={"GET","HEAD", "POST"}, name="user")
     */
    public function ficheUser(int $userId, SessionInterface $session): Response
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
                return $this->render('users/user.html.twig', ['user' => $user]);
            }
        }
        else{
            return $this->redirectToRoute('403'); 
        }
        

    }
}
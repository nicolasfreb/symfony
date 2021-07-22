<?php
namespace App\Controller\Administration;

use App\Services\MenusGeneral;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Utilisateurs;

class UsersController extends AbstractController
{
    /**
     * @Route("/Administration/users", methods={"GET","HEAD", "POST"}, name="users")
     */
    public function connexionForm(SessionInterface $session,  MenusGeneral $menus): Response
    {
        $menu = $menus->returnMenu();
        if( $session->get('acces') == 'Administrateur'){
            if(isset($_POST['userDelete'])){
                if($_POST['userDelete'] !=  $session->get('userId')){
                    $entityManager = $this->getDoctrine()->getManager();
                    $user = $entityManager->getRepository(Utilisateurs::class)->find($_POST['userDelete']);

                    $entityManager->remove($user);
                    $entityManager->flush(); 
                }
                else{
                    $this->addFlash(
                        'notice',
                        'Vous ne pouvez pas vous supprimer'
                    );
                }
                return $this->redirectToRoute('users'); 
            }
            else{
                $users = $this->getDoctrine()
                ->getRepository(Utilisateurs::class)
                ->findAll();
            
                if($users){
                    return $this->render('users/users.html.twig', ['users' => $users, 'menu' => $menu]);
                }
                else return $this->render('users/users.html.twig', ['menu' => $menu]);
            }
        }
        else{
            return $this->redirectToRoute('403'); 
        }
        

    }
}
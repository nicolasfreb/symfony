<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Utilisateurs;
use App\Services\Connexionbdd;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", methods={"GET","HEAD", "POST"}, name="register")
     */
    public function connexionForm(): Response
    {
        
        if(!empty ($_POST['email']) and !empty ($_POST['password']) and !empty ($_POST['login'])){

            $user = $this->getDoctrine()->getRepository(Utilisateurs::class);
            $loginfind = $user->findOneBy(['login' => $_POST['login']]);
            $emailfind = $user->findOneBy(['email' => $_POST['email']]);

            if( $loginfind){
                $this->addFlash(
                    'notice',
                    'ce login existe déja'
                ); 
            }
            if( $emailfind){
                $this->addFlash(
                    'notice',
                    'cet email existe déja'
                ); 
            }
            
          if(!$loginfind AND !$emailfind){
                $entityManager = $this->getDoctrine()->getManager();

                $utilisateur = new Utilisateurs();
                $utilisateur->setLogin($_POST['login']);
                $utilisateur->setPassword(md5($_POST['password']));
                $utilisateur->setEmail($_POST['email']);
    
                $entityManager->persist($utilisateur); 
                $entityManager->flush();   
                $this->addFlash(
                    'notice',
                    'Votre compte a été créé'
                );
                return $this->redirectToRoute('accueil'); 
            }
            else{
                return $this->render('register.html.twig');
            }
        }
        else{
            return $this->render('register.html.twig');
        }         
    }

}
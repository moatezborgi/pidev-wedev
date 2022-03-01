<?php

namespace App\Controller;

use App\Entity\Utilisateur;

use App\Form\AjoutuserType;
use App\Form\UtilisateurType;


use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function Symfony\Component\String\u;
use Swift_Mailer;
use Swift_Message;
class UtilisateurController extends AbstractController
{

    /**
     * @Route("/inscription", name="inscription")

     */
    public function inscription(Request $request , UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer,UtilisateurRepository  $utilisateurRepository)
    {

        $Utilisateur  = new Utilisateur ();

        $form= $this->createForm(UtilisateurType::class,$Utilisateur);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $password = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);

          /*  $Utilisateur->setMdp(
                $passwordEncoder->encodePassword($Utilisateur,
                    $form->get('mdp')->getData()
                )
            );*/


            $em= $this->getDoctrine()->getManager();
            $em->persist($Utilisateur );
            $em->flush();
            $this->getDoctrine()->getManager()->flush();
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('wedev122@gmail.com')
                ->setTo($form->get('email')->getData())//
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'registration.html.twig',
                        compact('user')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
            return $this->redirectToRoute("login");


        }
        return $this->render("utilisateur/inscription.html.twig",array("form"=>$form->createView()));
    }








/**
     * @Route("/ajouterUtilisateur", name="ajouterUtilisateur")

     */
    public function ajouterUtilisateur(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $Utilisateur  = new Utilisateur ();
        $form= $this->createForm(AjoutuserType::class,$Utilisateur);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

            /*     $Utilisateur->setMdp(
                     $passwordEncoder->encodePassword($Utilisateur,
                         $form->get('utilisateurmdp')->getData()
                     )
                 );
     */
            $new=$form->getData();
            $imageFile = $form->get('imageuser')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move(
                        'back\images',
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $Utilisateur->setImageuser($newFilename);
            }
            $em= $this->getDoctrine()->getManager();
            $em->persist($Utilisateur );
            $em->flush();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("afficherusers");


        }
        return $this->render("utilisateur/ajouterutilisateur.html.twig",array("form"=>$form->createView()));
    }

    /**
     * @Route("/afficherusers",name="afficherusers")
     */
    public function afficherusers   (UtilisateurRepository $repository){
        $tableusers=$repository->findAll();
        return $this->render('utilisateur/afficherusers.html.twig'
            ,['tableusers'=>$tableusers]);

    }

    /**
     * @Route("/supprimeruser/{id}",name="supprimeruser")
     */
    public function supprimeruser($id,EntityManagerInterface $em ,UtilisateurRepository $repository){
        $user=$repository->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('afficherusers');
    }

    /**
     * @Route("/{id}/modifieruser", name="modifieruser", methods={"GET","POST"})
     */
    public function modifieruser(Request $request, Utilisateur $user): Response
    {
        $form = $this->createForm(AjoutuserType::class, $user);


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageuser')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move(
                        'back\images',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $user->setImageuser($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('afficherusers');
        }

        return $this->render('utilisateur/modifierutilisateur.html.twig', [
            'usermodif' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function index(): Response
    {
        return $this->render('utilisateur/login.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/update-user", name="update_user")
     */
    public function updateUser(Request $request): Response
    {

        $form = $this->createForm(AjoutuserType::class);


        $form->handleRequest($request);
        return $this->render('utilisateur/update-user.html.twig', [
            'form'=>$form->createView(),
            'controller_name' => 'TestController',
        ]);
    }



}

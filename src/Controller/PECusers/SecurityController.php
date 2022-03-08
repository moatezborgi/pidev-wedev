<?php

namespace App\Controller\PECusers;

use App\Entity\Utilisateur;
use App\Form\ForgotPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Repository\UtilisateurRepository;

//use Symfony\Component\HttpFoundation\Request;


class SecurityController extends AbstractController
{
    /**
     *@Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response

    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
            

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        $this->redirectToRoute('modifieruser');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("/mot-passe-oublie",name="mot_de_passe_oublie")
     */
    public function forgottenPassword(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator): Response{
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $email = $form->get('email')->getData();
            $user = $entityManager->getRepository(Utilisateur::class)->findOneByEmail($email);
            if ($user[0] === null) {
                $this->addFlash('danger', 'Email Inconnu, recommence !');
                return $this->redirectToRoute('mot_de_passe_oublie');
            }
            $token = $tokenGenerator->generateToken();
            try {
                $user[0]->setResetToken($token);
                $entityManager->flush();
            }catch (\Exception $e){
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('new');
            }
            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Oubli de mot de passe - Réinisialisation'))
                ->setFrom('wedev122@gmail.com')
                ->setTo($user[0]->getEmail())
                ->setBody(
                    $this->renderView(
                        'security/resetPasswordMail.html.twig',
                        [
                            'user'=>$user[0],
                            'url'=>$url
                        ]
                    ),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('notice', 'Mail envoyé, tu vas pouvoir te connecter à nouveau !');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/forgottenPassword.html.twig',["form"=>$form->createView()]);
    }
    /**
     * @Route("/reinitialiser-mot-de-passe/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(Utilisateur::class)->findOneByResetToken($token);
            /* @var $user Utilisateur */

            if ($user[0] === null) {
                $this->addFlash('danger', 'Mot de passe non reconnu');
                return $this->redirectToRoute('new');
            }

            $user[0]->setResetToken("");
            $user[0]->setPassword($passwordEncoder->encodePassword($user[0], $request->request->get('password')));
            $entityManager->flush();

            $this->addFlash('notice', 'Mot de passe mis à jour !');

            return $this->redirectToRoute('app_login');
        }else {

            return $this->render('security/resetPassword.html.twig', ['token' => $token]);
        }


    }

}

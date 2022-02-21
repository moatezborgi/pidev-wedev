<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/acceuil" , name="home")
     */
    public function home()
    {
        return $this->render('index_controller_php/acceuil.html.twig');
    }


    /**
     * @Route("/admin")
     */
    public function dashboard()
    {
        return $this->render('utilisateur/admin.html.twig');
    }

    /**
     * @Route("/restaurant" , name="restaurant")
     */

    public function restaurant()
    {
        return $this->render('restauration/restaurant.html.twig');
    }





}

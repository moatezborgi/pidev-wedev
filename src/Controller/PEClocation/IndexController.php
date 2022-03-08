<?php

namespace App\Controller\PEClocation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/acceuil")
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
     * @Route("/restaurant")
     */
   
       public function restaurant()
    {
        return $this->render('restauration/restaurant.html.twig');
    }

    /**
     * @Route("/perstataire", name="prestataire")
     */

    public function prestataire ()
    {
        return $this->render('voiture/index.html.twig');
    }

    /**
     * @Route("/client", name="client")
     */

    public function client ()
    {
        return $this->render('client.html.twig');
    }
    /**
     * @Route("/locationvoiture")
     */

    public function locationvoiture ()
    {
        return $this->render('index_controller_php/index.html.twig');
    }

}

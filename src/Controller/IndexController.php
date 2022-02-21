<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class IndexController extends AbstractController
{


/**
    * @Route("/Backoffice/dashboard",name="Dashboard")
 */
public function home()
{
    return $this->render('basedashboard.html.twig');

}

/**
    * @Route("/Frontoffice/offrevoyage",name="offrevoyage")
 */
public function acceuil()
{
    return $this->render('basefront.html.twig');

}
}
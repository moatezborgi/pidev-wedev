<?php
namespace App\Controller\PECoffrevoyage;
use App\Entity\Hotel;
use App\Form\HotelType;
use App\Entity\ImageHotel;
use App\Entity\Chambre;
use App\Entity\Offrevoyage;
use App\Entity\Reservation;
use App\Form\ChambreType;
use App\Form\OffrevoyageType;
use App\Form\ReservationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;

use App\Repository\ImageHotelRepository;
use PHPUnit\Runner\Hook;
use Symfony\Component\HttpFoundation\JsonResponse;
class OffrevoyageController extends AbstractController

{

/**
 * @Route("/Backoffice/newoffre", name="new_offre")
 * Method({"GET", "POST"})
 */
public function new(Request $request) {
    $offre = new Offrevoyage();
    $entityManager = $this->getDoctrine()->getManager();

     $form = $this->createForm(OffrevoyageType::class,$offre);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
        $uploaddir= $this->getParameter('images_directory');

      $file=$request->files->get("offrevoyage")["image"];
       foreach($file as $image){
        $m='\\';
        $fichier_name = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move($uploaddir,$fichier_name);
        $image_hotel=new ImageHotel();
        $image_hotel->setImage("/".$fichier_name);
        $image_hotel->setReferHotel("RefOffre".$offre->getId());
        $entityManager->persist($image_hotel);
      }
      
      
        $offre = $form->getData();
        $offre->setId("RefOffre".$offre->getId());
  
        $entityManager->persist($offre);
        $entityManager->flush();

    return $this->redirectToRoute('new_offre');
    }
    return $this->render('Backoffice/PEC-offrevoyage/addoffrevoyage.html.twig',['form' => $form->createView()]);
    }


       /**
 * @Route("/Backoffice/listeoffre", name="listeoffre")
     */

    public function listeoffre()
    {
      $offre= $this->getDoctrine()->getRepository(Offrevoyage::class)->findAll();
      
       
       
      return $this->render('Backoffice/PEC-offrevoyage/listeoffre.html.twig',['offre'=> $offre]);
      
    }



/**
 * @Route("/Backoffice/editoffre/{id}", name="edit_offre")
 * Method({"GET", "POST"})
 */
public function editoffre(Request $request, $id) {
  $offre = new Offrevoyage($id);
  $image=new ImageHotel();
  $offre = $this->getDoctrine()->getRepository(Offrevoyage::class)->find($id);
  $image = $this->getDoctrine()->getRepository(ImageHotel::class)->findBy(array('referHotel' => $id));

  $form = $this->createForm(OffrevoyageType::class,$offre);
  $entityManager = $this->getDoctrine()->getManager();

  
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
    $uploaddir= $this->getParameter('images_directory');

      $file=$request->files->get("offrevoyage")["image"];
       foreach($file as $image){
        $m='\\';
        $fichier_name = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move($uploaddir,$fichier_name);
        $image_hotel=new ImageHotel();
        $image_hotel->setImage("/".$fichier_name);
        $image_hotel->setReferHotel($offre->getId());
        $entityManager->persist($image_hotel);
      }
      
  $entityManager->flush();
  
  return $this->redirectToRoute('listeoffre');
  }
  return $this->render('Backoffice/PEC-offrevoyage/addoffrevoyage.html.twig',['image' => $image,'form' => $form->createView()]);
}



    
    /**
     * @Route("/Backoffice/deloffre/{id}",name="supoffre")
     * @Method({"DELETE"})
  
     */
    public function supprimedeloffre(Offrevoyage $offre)
    {
      //  if($this->isCsrfTokenValid("SUP".$hotel->getReferHotel(),$request->get("_token")) )
      //  {
        //  $image = $this->getDoctrine()->getRepository($imagehotel)->findAll();
          
         // unlink($img->getImage());
        //    var_dump($image);
          // exit();

          $image = $this->getDoctrine()->getRepository(ImageHotel::class)->findBy(array('referHotel' => $offre->getId()));
          foreach($image as $images){
            unlink($this->getParameter('images_directory').'/'.$images->getImage());
          }
          
            $em=$this->getDoctrine()->getManager();
            $em->remove($offre);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
     //   }
        return $this->redirectToRoute('listeoffre');

    }


/**
    * @Route("/Frontoffice/listeoffrevoyage",name="listeoffrevoyage")
 */
public function acceuil()
{
  $offre= $this->getDoctrine()->getRepository(Offrevoyage::class)->findAll();
  $image = $this->getDoctrine()->getRepository(ImageHotel::class)->findAll(array('distinct' => true));
 
     return $this->render('Frontoffice/PEC-offrevoyage/offrevoyage.html.twig',['offre'=>$offre,'image'=>$image]);
 
}
/**
    * @Route("/Frontoffice/reserver/{id}",name="reserver")
 */
public function reserver(Request $request,$id)
{
  $reserver = new Reservation($id);
  $offre= $this->getDoctrine()->getRepository(Offrevoyage::class)->findBy(array('id' => $id));

     $entityManager = $this->getDoctrine()->getManager();

     $form = $this->createForm(ReservationType::class,$reserver);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
  
      
      
        $offre = $form->getData();
   
        $entityManager->persist($reserver);
        $entityManager->flush();

    return $this->redirectToRoute('listeoffrevoyage');
    }
      return $this->render('Frontoffice/PEC-offrevoyage/reserveroffre.html.twig',['form' => $form->createView(),'offre'=>$offre]);
 
}
      /**
 * @Route("/Backoffice/listrese", name="listrese")
     */

    public function liste_listrese()
    {
      $reserv= $this->getDoctrine()->getRepository(Reservation::class)->findAll();
      
      return $this->render('Backoffice/PEC-offrevoyage/listereser.html.twig',['reser'=> $reserv]);
      
    }

        /**
     * @Route("/Backoffice/delreser/{id}",name="supreserv")
     * @Method({"DELETE"})
  
     */
    public function supprimerHotel(Reservation $reserv)
    {
 
 
     
            $em=$this->getDoctrine()->getManager();
            $em->remove($reserv);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
     //   }
        return $this->redirectToRoute('listrese');

    }

}
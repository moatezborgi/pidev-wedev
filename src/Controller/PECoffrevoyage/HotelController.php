<?php
namespace App\Controller\PECoffrevoyage;
use App\Entity\Hotel;
use App\Form\HotelType;
use App\Entity\ImageHotel;
use App\Entity\Chambre;
use App\Form\ChambreType;
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
class HotelController extends AbstractController

{
 /**
 * @Route("/Backoffice/newhotel", name="new_hotel")
 * Method({"GET", "POST"})
 */
public function new(Request $request) {
    $hotel = new Hotel();
    $entityManager = $this->getDoctrine()->getManager();

     $form = $this->createForm(HotelType::class,$hotel);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
        $uploaddir= $this->getParameter('images_directory');

      $file=$request->files->get("hotel")["image"];
       foreach($file as $image){
        $m='\\';
        $fichier_name = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move($uploaddir,$fichier_name);
        $image_hotel=new ImageHotel();
        $image_hotel->setImage("/".$fichier_name);
        $image_hotel->setReferHotel("Refhôtel".$hotel->getId());
        $entityManager->persist($image_hotel);
      }
      
      
        $hotel = $form->getData();
        $hotel->setId("Refhôtel".$hotel->getId());
  
        $entityManager->persist($hotel);
        $entityManager->flush();

    return $this->redirectToRoute('new_hotel');
    }
    return $this->render('Backoffice/PEC-offrevoyage/addhotel.html.twig',['form' => $form->createView()]);
    }


       /**
 * @Route("/Backoffice/listhotel", name="listhotel")
     */

    public function liste_hotel()
    {
      $hotel= $this->getDoctrine()->getRepository(Hotel::class)->findAll();
      
      return $this->render('Backoffice/PEC-offrevoyage/listhotel.html.twig',['hotels'=> $hotel]);
      
    }

 
    
    /**
     * @Route("/Backoffice/delhotel/{id}",name="suphotel")
     * @Method({"DELETE"})
  
     */
    public function supprimerHotel(Hotel $hotel)
    {
      //  if($this->isCsrfTokenValid("SUP".$hotel->getReferHotel(),$request->get("_token")) )
      //  {
        //  $image = $this->getDoctrine()->getRepository($imagehotel)->findAll();
          
         // unlink($img->getImage());
        //    var_dump($image);
          // exit();

          $image = $this->getDoctrine()->getRepository(ImageHotel::class)->findBy(array('referHotel' => $hotel->getId()));
          foreach($image as $images){
            
            unlink($this->getParameter('images_directory').'/'.$images->getImage());
          }
          
            $em=$this->getDoctrine()->getManager();
            $em->remove($hotel);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
     //   }
        return $this->redirectToRoute('listhotel');

    }
/**
 * @Route("/Backoffice/show/{id}", name="hotelshow")
 */
public function show($id) {
  $hotel = $this->getDoctrine()->getRepository(Hotel::class) ->find($id);
  return $this->render('Backoffice/PEC-offrevoyage/show.html.twig',
  array('hotel' => $hotel));
   }

   /**
 * @Route("/Backoffice/edit/{id}", name="edit_hotel")
 * Method({"GET", "POST"})
 */
 public function edit(Request $request, $id) {
  $hotel = new Hotel();
  $image=new ImageHotel();
  $hotel = $this->getDoctrine()->getRepository(Hotel::class)->find($id);
  $image = $this->getDoctrine()->getRepository(ImageHotel::class)->findBy(array('referHotel' => $id));

  $form = $this->createForm(HotelType::class,$hotel);
  $entityManager = $this->getDoctrine()->getManager();

  
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
    $uploaddir= $this->getParameter('images_directory');

      $file=$request->files->get("hotel")["image"];
       foreach($file as $image){
        $m='\\';
        $fichier_name = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move($uploaddir,$fichier_name);
        $image_hotel=new ImageHotel();
        $image_hotel->setImage("/".$fichier_name);
        $image_hotel->setReferHotel($hotel->getId());
        $entityManager->persist($image_hotel);
      }
      
  $entityManager->flush();
  
  return $this->redirectToRoute('listhotel');
  }
  return $this->render('Backoffice/PEC-offrevoyage/addhotel.html.twig',['image' => $image,'form' => $form->createView()]);
}


 /**
     * @Route("/supprime/image_hotel/{id}", name="hotel_delete_image", methods={"DELETE"})
     */
    public function deleteImage(ImageHotel $image, Request $request){
      $data = json_decode($request->getContent(), true);

      // On vérifie si le token est valide
      if($this->isCsrfTokenValid('delete'.$image->getCodeImage(), $data['_token'])){
          // On récupère le nom de l'image
          $nom = $image->getImage();
          // On supprime le fichier
          unlink($this->getParameter('images_directory').'/'.$nom);

          // On supprime l'entrée de la base
          $em = $this->getDoctrine()->getManager();
          $em->remove($image);
          $em->flush();

          // On répond en json
          return new JsonResponse(['success' => 1]);
      }else{
          return new JsonResponse(['error' => 'Token Invalide'], 400);
      }
  }
 /**
 * @Route("/Backoffice/newchambre/{id}", name="new_chambre")
 * Method({"GET", "POST"})
 */
public function new_chambre(Request $request,$id) {

  $chambre = new Chambre($id);
 

  $entityManager = $this->getDoctrine()->getManager();
  //$hotel = $this->getDoctrine()->getRepository(Hotel::class)->find($id);

    $form = $this->createForm(ChambreType::class,$chambre) ;   
    $form->handleRequest($request);
       

  if($form->isSubmitted() && $form->isValid()) {
    $uploaddir= $this->getParameter('images_directory');

    $file=$request->files->get("chambre")["image"];
    foreach($file as $image){
      $m='\\';
      $fichier_name = md5(uniqid()) . '.' . $image->guessExtension();
      $image->move($uploaddir,$fichier_name);
      $image_hotel=new ImageHotel();
      $image_hotel->setImage("/".$fichier_name);
      $image_hotel->setReferHotel($chambre->getNumChambre());
      $entityManager->persist($image_hotel);
    }
      $chambre = $form->getData();
       
        $entityManager->persist($chambre);
        
    
     // $entityManager->persist($chambre);
      $entityManager->flush();

  return $this->render('Backoffice/PEC-offrevoyage/addchambre.html.twig',['form' => $form->createView(),'chambre'=> $chambre]);
    }
  return $this->render('Backoffice/PEC-offrevoyage/addchambre.html.twig',['form' => $form->createView(),'chambre'=> $chambre]);
  }


       /**
 * @Route("/Backoffice/listechambre/{id}", name="listechambre")
     */

    public function liste_chambre($id)
    {
      $chambre= $this->getDoctrine()->getRepository(Chambre::class)->findBy(array('referHotel' => $id));
      
      return $this->render('Backoffice/PEC-offrevoyage/listechambre.html.twig',['chambres'=> $chambre]);
      
    }



    
    /**
     * @Route("/Backoffice/delchambre/{id}",name="supchamp")
     * @Method({"DELETE"})
  
     */
    public function supprimerchambre(Chambre $chambre)
    {
      //  if($this->isCsrfTokenValid("SUP".$hotel->getReferHotel(),$request->get("_token")) )
      //  {
        //  $image = $this->getDoctrine()->getRepository($imagehotel)->findAll();
          
         // unlink($img->getImage());
        //    var_dump($image);
          // exit();

          $image = $this->getDoctrine()->getRepository(ImageHotel::class)->findBy(array('referHotel' => $chambre->getNumChambre()));
          foreach($image as $images){
            unlink($this->getParameter('images_directory').'/'.$images->getImage());
          }
          
            $em=$this->getDoctrine()->getManager();
            $em->remove($chambre);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
     //   }
        return $this->redirectToRoute('listhotel');

    }


 /**
 * @Route("/Backoffice/editchambre/{id}", name="edit_chambre")
 * Method({"GET", "POST"})
 */
public function editchambre(Request $request, $id) {
  $chambre = new Chambre($id);
  $image=new ImageHotel();
  $chambre = $this->getDoctrine()->getRepository(Chambre::class)->find($id);
  $image = $this->getDoctrine()->getRepository(ImageHotel::class)->findBy(array('referHotel' => $id));

  $form = $this->createForm(ChambreType::class,$chambre);
  $entityManager = $this->getDoctrine()->getManager();

  
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
    $uploaddir= $this->getParameter('images_directory');

      $file=$request->files->get("chambre")["image"];
       foreach($file as $image){
        $m='\\';
        $fichier_name = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move($uploaddir,$fichier_name);
        $image_hotel=new ImageHotel();
        $image_hotel->setImage("/".$fichier_name);
        $image_hotel->setReferHotel($chambre->getNumChambre());
        $entityManager->persist($image_hotel);
      }
      
  $entityManager->flush();
  
  return $this->redirectToRoute('listhotel');
  }
  return $this->render('Backoffice/PEC-offrevoyage/addchambre.html.twig',['image' => $image,'form' => $form->createView()]);
}


}
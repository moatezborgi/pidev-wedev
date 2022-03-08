<?php
namespace App\Controller\RestaurationController;
use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Form\Reservation1Type;
use App\Entity\ImageResto;
use App\Entity\Categorie;
use App\Entity\Rating;
use App\Entity\Menu;
use App\Entity\Reservation1;
use App\Repository\CategorieRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Endroid\QrCode\Builder\BuilderInterface;
use App\Entity\Utilisateur;
use App\Repository\Reservation1Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Builder\Builder;


class RestaurantController extends AbstractController

{
 /**
 * @Route("/restaurant/newresto", name="new_resto")
 * Method({"GET", "POST"})
 */
public function new(Request $request) {
    $resto = new Restaurant();
    $entityManager = $this->getDoctrine()->getManager();
 
     $form = $this->createForm(RestaurantType::class,$resto);    
     
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
        $uploaddir= $this->getParameter('images_directory');

      $file=$request->files->get("restaurant")["image"];
       foreach($file as $image){
        
        $fichier_name = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move($uploaddir,$fichier_name);
        $image_resto=new ImageResto();
        $image_resto->setImage('/'.$fichier_name);
        $image_resto->setReferResto("resto".$resto->getReferResto());
        $entityManager->persist($image_resto);
      }
      
      
        $resto = $form->getData();
        $resto->setReferResto("resto".$resto->getReferResto());
        $entityManager->persist($resto);
        $entityManager->flush();

    return $this->redirectToRoute('new_resto');
    }
    return $this->render('restauration/ajouter_restaurant.html.twig',['form' => $form->createView()]);
    }
   
       /**
     * @Route("/restaurant/liste_restaurant", name="listresto")
     */

    public function liste_resto()
    {
      $restaurant= $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
      
      return $this->render('restauration/liste_restaurant.html.twig',['resto'=> $restaurant]);
      
    }
      /**
     * @Route("/restaurant/delresto/{id}",name="supresto")
  
     */
    public function supprimeresto(Restaurant $resto,Request $request,ManagerRegistry $objectManager)
    {
        if($this->isCsrfTokenValid("SUP".$resto->getReferResto(),$request->get("_token")) )
        {
        //  $image = $this->getDoctrine()->getRepository($imagehotel)->findAll();
          
         // unlink($img->getImage());
        //    var_dump($image);
          // exit();
          
            $em=$objectManager->getManager();
            $em->remove($resto);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
        }
        return $this->redirectToRoute('listresto');

    }
       
/**
 * @Route("/restaurant/Listeplat/{id}", name="Listeplat")
     */

    public function liste_menu($id)
    {
      $menu= $this->getDoctrine()->getRepository(Menu::class)->findBy(array('referResto' => $id));
      
      return $this->render('restauration/liste_menu.html.twig',['menus'=> $menu]);
      
    }



/**
 * @Route("/restaurant/editresto/{id}", name="editresto")
 * Method({"GET", "POST"})
 */
public function editresto(Request $request, $id) {
  $resto = new Restaurant();
  $entityManager = $this->getDoctrine()->getManager();
  $resto = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);

   $form = $this->createForm(RestaurantType::class,$resto);    
   
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
      
    
      $resto = $form->getData();
      $resto->setReferResto("resto".$resto->getReferResto());
      $entityManager->flush();
 
  return $this->redirectToRoute('listresto');
  }
  return $this->render('restauration/ajouter_restaurant.html.twig',['form' => $form->createView()]);
  }
    /**
     * @Route("/restaurant/liste_restaurantfront", name="listrestofront")
     */

    public function liste_resto_front()
    {
      $restaurant= $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
      $image = $this->getDoctrine()->getRepository(ImageResto::class)->findAll();
      return $this->render('restauration/restaurant_front.html.twig',['resto'=> $restaurant,'image'=>$image]);
      
    }
     /**
     * @Route("/restaurant/detail_restaurantfront/{id}", name="detailresto")
     */

    public function detailresto($id, CategorieRepository $repo)
    {
      $restaurant= $this->getDoctrine()->getRepository(Restaurant::class)->findBy(array('referResto' => $id));
      $image = $this->getDoctrine()->getRepository(ImageResto::class)->findBy(array('referResto' => $id));
      $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
      $menu = $this->getDoctrine()->getRepository(Menu::class)->findBy(array('referResto' => $id));

      return $this->render('restauration/restaurant.html.twig',['resto'=> $restaurant,'image'=>$image,'menu'=>$menu,'cat'=>$categorie]);
      
    }
    public function QR( $id,Reservation1Repository $reser,$login){
      $p=$reser->find($id);
      
  $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findBy(array('login' => $login));
  foreach ($user as $event)
  {
   $name=$event->getNom()." ".$event->getPrenom();
 
  }
      $date=$p->getDateReservation();
      $result = Builder::create()
          ->writer(new PngWriter())
          ->writerOptions([])
          ->data('Client: '.$name.' reservation pour le : '.$date->format('d/m/Y'))
          ->encoding(new Encoding('UTF-8'))
          ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
          ->size(300)
          ->margin(10)
          ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
          ->labelText($name.' resrvation  '.$name)
          ->labelFont(new NotoSans(20))
          ->labelAlignment(new LabelAlignmentCenter())
          ->build();
      header('Content-Type: '.$result->getMimeType());

      $result->saveToFile('QRcode/'.'client'.$name.'reservation'.$name.'.png');
      return 'QRcode/'.'client'.$name.'reservation'.$name.'.png' ;
  }
   

     /**
 * @Route("/restaurant/reserver/{id}/{login}", name="new_reservation")
 * Method({"GET", "POST"})
 */
public function ajout_Reservation(Request $request, $id,$login, \Swift_Mailer $mailer,Reservation1Repository $res) {
  $reserver= new Reservation1($id,null,null,null);
  $entityManager = $this->getDoctrine()->getManager();
  $restaurant= $this->getDoctrine()->getRepository(Restaurant::class)->findBy(array('referResto' => $id));

  $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findBy(array('login' => $login));
  foreach ($user as $event)
  {
  $reserver = new Reservation1($id,$event->getTel(),$event->getNom(),$event->getPrenom());
  $nom=$event->getNom();
  $prenom=$event->getPrenom();
  $mail=$event->getEmail();
 
  }
   $form = $this->createForm(Reservation1Type::class,$reserver);    
   
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
    
      $reserver = $form->getData();
      $entityManager->persist($reserver);
      $entityManager->flush();
      $nbs = $res->getLastid();
      foreach($nbs as $nb)
      {
          $refres= $nb['maxid'];
      }
      $username = 'troodtrood18@gmail.com';

      // On crée le message
      $message = (new \Swift_Message("MR/MME".$nom ." ".$prenom."Votre réservation à été effectué TROOD confiramtion de réservation"))
          // On attribue l'expéditeur
          ->setFrom($username)
          ->setTo($mail);
          $img = $message->embed(\Swift_Image::fromPath($this->qr($refres,$res,$login)));

          $message->setBody( $this->renderView(
            // templates/emails/registration.html.twig
                'qr.html.twig',
                ['qr'=> $img
                ]            ),
            'text/html');
      $mailer->send($message);

   
  return $this->redirectToRoute('listrestofront');
  }
  return $this->render('restauration/reservation.html.twig',['form' => $form->createView(),'resto'=>$restaurant]);
  }


      /**
     * @Route("/restaurant/liste_reservation", name="listreservation")
     */

    public function liste_Reservation()
    {
      $reserver= $this->getDoctrine()->getRepository(Reservation1::class)->findAll();
      
      return $this->render('restauration/liste_reservation.html.twig',['reserver'=> $reserver]);
      
    }

    /**
 * @Route("/restaurant/editreservation/{id}", name="editreservation")
 * Method({"GET", "POST"})
 */
public function editReservation(Request $request, $id) {
  $reserver = new Reservation1($id);
  $entityManager = $this->getDoctrine()->getManager();
  $reserver = $this->getDoctrine()->getRepository(Reservation1::class)->find($id);
  $restaurant= $this->getDoctrine()->getRepository(Restaurant::class)->findBy(array('referResto' => $id));


   $form = $this->createForm(Reservation1Type::class,$reserver);    
   
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
      
    
      $reserver = $form->getData();
      $reserver->setReferResto("reserver".$reserver->getReferResto());
      $entityManager->flush();
 
  return $this->redirectToRoute('listreservation');
  }
  return $this->render('restauration/reservation.html.twig',['form' => $form->createView(),'resto'=>$restaurant]);
  }




    /**
     * @Route("/restaurant/delreservation/{id}",name="supreservation")
  
     */
    public function supprimereservation(Reservation1 $reserver,Request $request,ManagerRegistry $objectManager)
    {
        
            $em=$objectManager->getManager();
            $em->remove($reserver);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
        
        return $this->redirectToRoute('listreservation');

    }




     
    /**
     * @Route("/searchajax ", name="ajax")
     */
    public function searchOffreajax(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Restaurant::class);
        $image = $this->getDoctrine()->getRepository(ImageResto::class)->findAll();
        $requestString=$request->get('searchValue');
        $restaurant = $repository->findRestaurantbyajax($requestString);

        return $this->render('restauration/restoajax.html.twig', [
            "resto"=>$restaurant,
            "image"=>$image
        ]);
    }

/**
* @Route("/addrating ", name="addrating1")
*/
public function searchStudentx(Request $request)
{
  $ref=$request->get('ref');
  $rat=$request->get('rating');
  $rating =new Rating($ref,$rat,$request->get('login'));
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->persist($rating);
  $entityManager->flush();
}

}
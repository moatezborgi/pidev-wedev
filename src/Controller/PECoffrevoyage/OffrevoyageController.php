<?php
namespace App\Controller\PECoffrevoyage;
use App\Entity\Hotel;
use App\Form\HotelType;
use App\Entity\ImageHotel;
use App\Entity\Chambre;
use App\Entity\Offrevoyage;
use App\Entity\Reservation;
use App\Entity\Rating;
use App\Entity\Utilisateur;
use App\Repository\ReservationRepository;

use App\Form\ChambreType;
use App\Form\OffrevoyageType;
use App\Form\ReservationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
use App\Repository\CalendarRepository;
use App\Entity\Calendar;

use App\Form\CalendarType;
use App\Repository\OffrevoyageRepository;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Builder\Builder;
use Symfony\Component\Validator\Constraints\Unique;

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

public function QR( $id, OffrevoyageRepository $reser,$login){
  $p=$reser->find($id);
  
$user = $this->getDoctrine()->getRepository(Utilisateur::class)->findBy(array('login' => $login));
foreach ($user as $event)
{
$name=$event->getNom()." ".$event->getPrenom();

}
  $offre=$p->getDescriptions();
  $result = Builder::create()
      ->writer(new PngWriter())
      ->writerOptions([])
      ->data('Client: '.$name.' reservation pour offre  : '.$offre)
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

  $result->saveToFile('QRcode/'.md5(uniqid()).'.png');
  return 'QRcode/'.md5(uniqid()).'.png';
}


/**
    * @Route("/Frontoffice/reserver/{id}/{login}",name="reserver")
 */
public function reserver(Request $request,$id, \Swift_Mailer $mailer,$login, OffrevoyageRepository $res,ReservationRepository $ress)
{
  $reserver= new Reservation($id,null,null,null,null);
  $offre= $this->getDoctrine()->getRepository(Offrevoyage::class)->findBy(array('id' => $id));
   $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findBy(array('login' => $login));
   foreach ($user as $event)
   {
   $reserver = new Reservation($id,$event->getNom(),$event->getPrenom(),$event->getTel(),$login);
   $nom=$event->getNom();
   $prenom=$event->getPrenom();
   $mail=$event->getEmail();

   }
  $entityManager = $this->getDoctrine()->getManager();
  $form = $this->createForm(ReservationType::class,$reserver);
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
        $offre = $form->getData();
        $entityManager->persist($reserver);
        $entityManager->flush();
        $nbs = $ress->getLastid($login);
        foreach($nbs as $nb)
        {
            $refres= $nb['maxid'];
        }
        $username = 'troodtrood18@gmail.com';
        // On crée le message
        $message = (new \Swift_Message('TROOD confiramtion de réservation'))
            // On attribue l'expéditeur
            ->setFrom($username)
            ->setTo($mail);
            $img = $message->embed(\Swift_Image::fromPath($this->qr($id,$res,$login)));

            $message->setBody( $this->renderView(
              // templates/emails/registration.html.twig
                  'qr.html.twig',
                  ['qr'=> $img
                  ]            ),
              'text/html');
         $mailer->send($message);
    

    return $this->redirectToRoute('listeoffrevoyage');
    }
    if($login==='null')
    
    {
      return $this->redirectToRoute('app_login');

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

/**
* @Route("/addrating ", name="addrating")
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

    
 /**
     * @Route("/offres/create-checkout-session/{price}", name="checkout")
     */
    public function checkout(OffrevoyageRepository $repository)
    {
        $offres = $repository->findAll();
        \Stripe\Stripe::setApiKey('sk_test_51KZg7pHCuNQN10APLyePZDZxMBz1Y97GTaJXxcJCAqnPjYSqTUSTmtzUV7rQn748y35jNqeJJnO6ZxElkuXOuzrj00pyc3ao47');
        $session = \Stripe\Checkout\Session::create([
                  'payment_method_types' => ['card'],
                   'line_items' => [[
                                 'price_data' => [
                                 'currency' => 'usd',
                                 'product_data' => [
                                  'name' => 'T-shirt',
        ],
        'unit_amount'=> 150,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    # These placeholder URLs will be replaced in a following step.
    'success_url'=> $this->generateUrl('success',[],UrlGeneratorInterface::ABSOLUTE_URL),
    'cancel_url' => $this->generateUrl('echec',[],UrlGeneratorInterface::ABSOLUTE_URL),

    ]);
        return new JsonResponse(['id'=>$session->id]);
    }


    /**
     * @Route("/offres/success", name="success")
     */

    public function success(): Response
    {

      return $this->render('Frontoffice/PEC-offrevoyage/success.html.twig');

        
    }
    /**
     * @Route("/offres/echec", name="echec")
     */


    public function echec(): Response
    {
      return $this->render('Frontoffice/PEC-offrevoyage/echec.html.twig');

         
    }
     /**
     * @Route("/admin/calendrier", name="calendrier")
     */
    public function calendrier_offre(OffrevoyageRepository $repository)
    {
        $offres=$repository->findAll();

        $rdvs = [];

        foreach ($offres as $event)
        {
          $rdvs[]=[
            'id'=>$event->getId(),
            'start'=>$event->getDateDepart()->format('Y-m-d H:i:s'),
            'end'=>$event->getDateRetour()->format('Y-m-d H:i:s'),
            'title'=>$event->getDescriptions(),
            'description'=>$event->getDescriptions(),
              'backgroundColor'=> 'aquamarine',
              'borderColor'=> 'green',
              'textColor' => 'black'
                  ];
        }

        $data = json_encode($rdvs);
        return $this->render('Backoffice/PEC-offrevoyage/offrecalender.html.twig', compact('data'));
    }
    
}
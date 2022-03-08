<?php
namespace App\Controller\RestaurationController;
use App\Form\CategorieType;
use App\Entity\ImageResto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Categorie;

class CategorieController extends AbstractController

{
 /**
 * @Route("/restaurant/newcat", name="new_cat")
 * Method({"GET", "POST"})
 */
public function new(Request $request) {
    $categorie = new Categorie();
    $entityManager = $this->getDoctrine()->getManager();

     $form = $this->createForm(CategorieType::class,$categorie);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
         
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($categorie);
        $entityManager->flush();
        
        $categorie = $form->getData();
        $entityManager->persist($categorie);
        $entityManager->flush();

    return $this->redirectToRoute('new_cat');
        }
      
      
     
    return $this->render('restauration/ajouter_categorie.html.twig',['form' => $form->createView()]);
    }
   

       /**
       * @Route("/restaurant/listcat", name="listcat")
       */

    public function liste_cat()
    {
      $cat= $this->getDoctrine()->getRepository(Categorie::class)->findAll();
      
      return $this->render('restauration/liste_cat.html.twig',['cat'=> $cat]);
      
    }


      /**
     * @Route("/restaurant/delcat/{id}",name="supcat")
  
     */
    public function supprimercat(Categorie $cat,Request $request,ManagerRegistry $objectManager)
    {
        if($this->isCsrfTokenValid("SUP".$cat->getid(),$request->get("_token")) )
        {
        //  $image = $this->getDoctrine()->getRepository($imagehotel)->findAll();
          
         // unlink($img->getImage());
        //    var_dump($image);
          // exit();
          
            $em=$objectManager->getManager();
            $em->remove($cat);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
        }
        return $this->redirectToRoute('listcat');

    }
 /**
 * @Route("/restaurant/modcat/{id}", name="modcat")
 * Method({"GET", "POST"})
 */
public function modifcat(Request $request,$id) {
  $categorie = new Categorie();
  $entityManager = $this->getDoctrine()->getManager();
  $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find($id);

   $form = $this->createForm(CategorieType::class,$categorie);
  $form->handleRequest($request);
  if($form->isSubmitted() && $form->isValid()) {
       
      $entityManager = $this->getDoctrine()->getManager();
       
      $categorie = $form->getData();
       $entityManager->flush();

  return $this->redirectToRoute('listcat');
      }
    
    
   
  return $this->render('restauration/ajouter_categorie.html.twig',['form' => $form->createView()]);
  }
 
}
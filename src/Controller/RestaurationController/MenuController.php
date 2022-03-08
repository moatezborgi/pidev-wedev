<?php
namespace App\Controller\RestaurationController;
use App\Entity\Menu;
use App\Form\MenuType;
use App\Entity\ImageMenu;
use App\Repository\CategorieRepository;
use App\Repository\MenuRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;

class MenuController extends AbstractController

{
 /**
 * @Route("/restaurant/newmenu/{id}", name="new_menu")
 * Method({"GET", "POST"})
 */
public function new(Request $request ,$id) {
    $menu = new Menu($id);
    $entityManager = $this->getDoctrine()->getManager();

     $form = $this->createForm(MenuType::class,$menu);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
      
        $menu = $form->getData();
         $entityManager->persist($menu);
        $entityManager->flush();

    return $this->redirectToRoute('listresto');
    }
    return $this->render('restauration/ajouter_menu.html.twig',['form' => $form->createView()]);
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
     * @Route("/restaurant/delmenu/{id}",name="supmenu")
  
     */
    public function supprimemenu(Menu $menu,Request $request,ManagerRegistry $objectManager)
    {
       
          
            $em=$objectManager->getManager();
            $em->remove($menu);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
      
        return $this->redirectToRoute('listresto');

    }

 /**
 * @Route("/restaurant/editmenu/{id}", name="editmenu")
 * Method({"GET", "POST"})
 */
public function editmenu(Request $request ,$id) {
    $menu = new Menu($id);
    $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id);

    $entityManager = $this->getDoctrine()->getManager();

     $form = $this->createForm(MenuType::class,$menu);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
      
        $menu = $form->getData();
         $entityManager->flush();

    return $this->redirectToRoute('listresto');
    }
    return $this->render('restauration/ajouter_menu.html.twig',['form' => $form->createView()]);
    }
    /**
     * @route ("/choix_categorie/{id}", name="choix_categorie")
     */

    public function choix_categorie(CategorieRepository $categorieRepository, MenuRepository $menuRepository, RestaurantRepository $rep, $id)
    {
        $categories = $categorieRepository->findAll();
        $resto =$rep->findAll();
        $menu =$menuRepository->findBy(array('Categorie'=>$id));
        return $this->render('restauration/choix_categorie.html.twig', [
            'cat' => $categories,
            'menu'=>$menu,
            'resto'=>$resto
        ]);
    }
}
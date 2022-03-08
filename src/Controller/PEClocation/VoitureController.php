<?php

namespace App\Controller\PEClocation;
use Symfony\Bundle\FrameworkBundle\Controller;
use App\Entity\Voiture;
use App\Form\VoitureType;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Imagevoiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="voiture")
     */
    public function index(): Response
    {

        return $this->render('voiture/index.html.twig');
    }

    /**
     * @Route("/newvoiture", name="create_voiture", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        $voiture = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('listevoiture');
        }

        return $this->render('voiture/new_voiture_front.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }
    /** 
     * @Route("/modifiervoitureback/{mat}", name="car_edit")
     * methods=({"GET", "POST"})
     */
    public function edit(Request $request,$mat): Response
    {
        $voiture = new Voiture();
            $voiture = $this->getDoctrine()->getRepository(Voiture::class)->findOneBy(array('Matricule' => $mat));
        
             $entityManager = $this->getDoctrine()->getManager();
        
             $form = $this->createForm(VoitureType::class,$voiture);
             $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $voiture = $form->getData();
                $entityManager->flush();
            return $this->redirectToRoute('listevoiture');
        }

        return $this->render('voiture/modifier.html.twig', ['form' => $form->createView()]);
    }

        /**
     * @Route("/listedesvoituresdispo", name="listevoituredispo")
     */
    public function afficherdispo(): Response
    {
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findByAVailibility();

        return $this->render('voiture/afficherdispo.html.twig', [
            'voitures' => $voitures,
        ]);
    }
    /**
     * @Route("/listedesvoitures", name="listevoiture")
     */
    public function afficher(): Response
    {
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findAll();

        return $this->render('voiture/afficher.html.twig', [
            'voitures' => $voitures,
        ]);
    }
    /**
     * @Route("/backlistedesvoitures", name="listevoitureback")
     */
    public function afficherback(): Response
    {
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findByAVailibility();

        return $this->render('voiture/affichageback.html.twig', [
            'voitures' => $voitures,
        ]);
    }
    /**
     * @Route("/voiture/{mat}", name="voiturebymat")
     */
    public function affiche(string $mat): Response
    {
        $voitures=$this->getDoctrine()->getRepository(Voiture::class)->findBy(array('matricule' =>$mat));
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }
    public function pdf()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('voiture/afficher.html.twig', [
            'title' => "Welcome to our PDF Test"
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("listevoiture.pdf", [
            "Attachment" => true
        ]);
    }
     /**
     * @Route("/delcar/{id}")
      * @Method({"DELETE"})

     */
    public function supprimemenu(Voiture $voiture)
    {
       
          
        $em=$this->getDoctrine()->getManager();
        $em->remove($voiture);
            
             
            $em->flush();
            $this->addFlash('success',"L'action a ete effectué");
      
        return $this->redirectToRoute('listevoitureback');

    }



}

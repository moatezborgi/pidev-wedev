<?php

namespace App\Controller\PEClocation;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Voiture;
use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\VoitureRepository;
use App\Repository\ContratRepository;

class ContratController extends AbstractController
{

    /**
     * @Route("/listecontrat", name="contrat_index", methods={"GET"})
     */
    public function index(ContratRepository $contratRepository): Response
    {
        return $this->render('Contrat/index.html.twig', [
            'contrats' => $contratRepository->findAll(),
        ]);
    }
    /**
     * @Route("/listecontratback", name="contrat_indexback", methods={"GET"})
     */
    public function indexback(ContratRepository $contratRepository): Response
    {
        return $this->render('Contrat/indexback.html.twig', [
            'contrats' => $contratRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="contrat_new", methods={"GET","POST"})
     *
     */
    public function new(Request $request, VoitureRepository $voitureRepository): Response
    {
        $contrat = new Contrat();
        $contrat->setDatedebut(new\DateTime('now'));
        $contrat->setDateretour(new\DateTime('tomorrow'));
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dateretour=$contrat->getDateretour();
            $Datedebut=$contrat->getDatedebut();
            $nbJours =$dateretour->diff($Datedebut)->days;
            if($nbJours>=1 && $dateretour>$Datedebut){

                $voiture=$this->getDoctrine()->getRepository(Voiture::class)->find($contrat->getVoiturealouer());

                $montantdelocation=$nbJours*($voiture->getPrixparheure());
                $contrat->setPrixLocation( $montantdelocation);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($contrat);
                $entityManager->flush();
                $entityManager->persist($voiture);
                $entityManager->flush();

                return $this->redirectToRoute('contrat_index');
            }
            $erreur="date retour doit etre superieur a la date debut minimum 1 jour";
            return $this->render('Contrat/newerreur.html.twig', [
                'Contrat' => $contrat,
                'form' => $form->createView(),
                'error'=>$erreur,
                'nbjours'=>$nbJours,
                'Datedebut'=>$Datedebut,
                'dateretour'=>$dateretour,
            ]);
        }

        return $this->render('Contrat/new.html.twig', [
            'Contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contrat/{id}",  methods={"GET","POST"})
     *
     */
    public function voiturebientodispo(Request $request, VoitureRepository $voitureRepository, $id): Response
    {
        $entityManager= $this->getDoctrine()->getManager();
        $contrat=$this->getDoctrine()->getRepository(Contrat::class)->findBy(array('id' =>$id));

        $Datedebut =$contrat->setDatedebut(new\DateTime('now'));
        $dateretour=$contrat->getDateretour();

            $nbJoursavantretour =$dateretour->diff($Datedebut)->days;


                $voiture=$this->getDoctrine()->getRepository(Voiture::class)->find($contrat->getVoiturealouer());

        return $this->render('Contrat/new.html.twig', [
            'Contrat' => $contrat
        ]);
    }
    /**
     * @Route("/edit/{id}", name="contrat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contrat $contrat): Response
    {

        $contrat->setDatedebut(new\DateTime('now'));
        $contrat->setDateretour(new\DateTime('tomorrow'));
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateretour=$contrat->getDateretour();
            $Datedebut=$contrat->getDatedebut();
            $nbJours =$dateretour->diff($Datedebut)->days;
            if($nbJours>=1 && $dateretour>$Datedebut){

                $voiture=$this->getDoctrine()->getRepository(Voiture::class)->find($contrat->getVoiturealouer());
                $voiture->setDisponibilite(1);
                $montantdelocation=$nbJours*($voiture->getPrixparheure());
                $contrat->setPrixLocation( $montantdelocation);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($contrat);
                $entityManager->flush();
                $entityManager->persist($voiture);
                $entityManager->flush();

                return $this->redirectToRoute('contrat_index');
            }
        }

        return $this->render('Contrat/edit.html.twig', [
            'Contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/delete/{id}", name="contrat_delete")
     *
     */
    public function delete(Request $request, string $id): Response
    {   $entityManager= $this->getDoctrine()->getManager();
        $contrats=$this->getDoctrine()->getRepository(Contrat::class)->findBy(array('id' =>$id));

        $entityManager->remove($contrats[0]);
        $entityManager->flush();

        return $this->redirectToRoute('contrat_index');
    }
    public function imprimercontat()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('contrat/afficher.html.twig', [
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
}

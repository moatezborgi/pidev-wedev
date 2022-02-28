<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\HotelRepository;
use App\Repository\MaisonRepository;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;


/**
 * @Route("/rec")
 */
class RecController extends AbstractController
{
    /**
     * @Route("/", name="rec_index", methods={"GET"})
     */
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('rec/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rec_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('rec/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rec_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('rec/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rec_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('rec_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rec/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rec_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rec_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @param ReclamationRepository $repository
     * @return Response
     * @Route ("tri",name="tri")
     */
    function OrderByPrice(ReclamationRepository  $repository){
        $reclamations=$repository->OrderByPrice();
        return $this->render("rec/index.html.twig",['reclamations'=>$reclamations]);
    }
    /**
     * @Route("imp", name="impr")
     */
    public function imprimeproduit(ReclamationRepository $repository): Response

    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $reclamations = $repository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('rec/pdf.html.twig', [
            'reclamations' => $reclamations,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste  Reclamation.pdf", [
            "Attachment" => true
        ]);

    }

    /**
     * @Route("statistiques",name="statistiquesRec")
     * @param ReclamationRepository $repository
     * @return Response
     */

    public function statistiques(ReclamationRepository $repository)
    {

        $nbs = $repository->getART();
        $data = [['rate', 'Reclamation']];
        foreach($nbs as $nb)
        {
            $data[] = array($nb['typeRec'], $nb['rec']);
        }
        $bar = new barchart();
        $bar->getData()->setArrayToDataTable(
            $data
        );

        $bar->getOptions()->getTitleTextStyle()->setColor('#07600');
        $bar->getOptions()->getTitleTextStyle()->setFontSize(50);
        return $this->render('rec/statistique.html.twig', array('barchart' => $bar,'nbs' => $nbs));

    }
}

<?php

namespace App\Controller;

use App\Entity\DossierMedicale;
use App\Form\DossierMedicaleType;
use App\Repository\DossierMedicaleRepository;
use App\Repository\MedecinRepository;
use App\Repository\ResponsableAdministratifRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dossier-medicale')]
class DossierMedicaleController extends AbstractController
{
    #[Route('/', name: 'app_dossier_medicale_index', methods: ['GET'])]
    public function index(DossierMedicaleRepository $dossierMedicaleRepository): Response
    {
        return $this->render('dossier_medicale/index.html.twig', [
            'dossier_medicales' => $dossierMedicaleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dossier_medicale_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request, 
        EntityManagerInterface $entityManager,
        MedecinRepository $medecinRepository,
        ResponsableAdministratifRepository $responsableAdminRepository
    ): Response
    {
        $dossierMedicale = new DossierMedicale();
        
        // Hardcoded IDs - replace with actual IDs from your database
        $medecin = $medecinRepository->find(1); // Assuming ID 1 exists
        $responsableAdmin = $responsableAdminRepository->find(1); // Assuming ID 1 exists
        
        $dossierMedicale->setMedecin($medecin);
        $dossierMedicale->setResponsableAdministratif($responsableAdmin);
        
        $form = $this->createForm(DossierMedicaleType::class, $dossierMedicale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dossierMedicale);
            $entityManager->flush();

            $this->addFlash('success', 'Le dossier médical a été créé avec succès.');
            return $this->redirectToRoute('app_dossier_medicale_index');
        }

        return $this->render('dossier_medicale/new.html.twig', [
            'dossier_medicale' => $dossierMedicale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_medicale_show', methods: ['GET'])]
    public function show(DossierMedicale $dossierMedicale): Response
    {
        return $this->render('dossier_medicale/show.html.twig', [
            'dossier_medicale' => $dossierMedicale,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_medicale_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DossierMedicale $dossierMedicale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DossierMedicaleType::class, $dossierMedicale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Le dossier médical a été modifié avec succès.');
            return $this->redirectToRoute('app_dossier_medicale_index');
        }

        return $this->render('dossier_medicale/edit.html.twig', [
            'dossier_medicale' => $dossierMedicale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_medicale_delete', methods: ['POST'])]
    public function delete(Request $request, DossierMedicale $dossierMedicale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossierMedicale->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dossierMedicale);
            $entityManager->flush();
            $this->addFlash('success', 'Le dossier médical a été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_dossier_medicale_index');
    }
} 
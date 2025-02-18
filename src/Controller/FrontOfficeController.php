<?php

namespace App\Controller;

use App\Repository\DossierMedicaleRepository;
use App\Repository\SejourRepository;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mon-espace')]
class FrontOfficeController extends AbstractController
{
    #[Route('/', name: 'app_front_office_dashboard')]
    public function dashboard(
        DossierMedicaleRepository $dossierMedicaleRepository,
        SejourRepository $sejourRepository,
        PatientRepository $patientRepository
    ): Response {
        // For now, we'll use a hardcoded patient ID (1) since we don't have authentication
        $patient = $patientRepository->find(1);
        
        if (!$patient) {
            throw $this->createNotFoundException('Patient not found');
        }

        $dossiersMedicaux = $dossierMedicaleRepository->findBy(['patient' => $patient]);
        
        return $this->render('front_office/dashboard.html.twig', [
            'patient' => $patient,
            'dossiers_medicaux' => $dossiersMedicaux,
        ]);
    }

    #[Route('/dossier-medical/{id}', name: 'app_front_office_dossier_show')]
    public function showDossier(
        $id,
        DossierMedicaleRepository $dossierMedicaleRepository,
        SejourRepository $sejourRepository
    ): Response {
        $dossier = $dossierMedicaleRepository->find($id);
        
        if (!$dossier) {
            throw $this->createNotFoundException('Dossier médical not found');
        }
        
        // For now, we'll skip the security check since we don't have authentication
        // In production, you should check if the current user owns this dossier
        
        $sejours = $sejourRepository->findBy(['dossierMedicale' => $dossier]);
        
        return $this->render('front_office/dossier_show.html.twig', [
            'dossier' => $dossier,
            'sejours' => $sejours,
        ]);
    }

    #[Route('/sejour/{id}', name: 'app_front_office_sejour_show')]
    public function showSejour($id, SejourRepository $sejourRepository): Response
    {
        $sejour = $sejourRepository->find($id);
        
        if (!$sejour) {
            throw $this->createNotFoundException('Séjour not found');
        }
        
        // For now, we'll skip the security check since we don't have authentication
        // In production, you should check if the current user owns this sejour
        
        return $this->render('front_office/sejour_show.html.twig', [
            'sejour' => $sejour,
        ]);
    }
} 
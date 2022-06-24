<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Planning;
use App\Form\PlanningType;
use App\Repository\PlanningRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ANIMATEUR')]
#[Route('/planning')]
class PlanningController extends AbstractController
{
    #[Route('/', name: 'app_planning_index', methods: ['GET'])]
    public function index(PlanningRepository $planningRepository): Response

    {
        return $this->render('planning/index.html.twig', [

            'plannings'    => $planningRepository->findAll(),
            'ateliers'    => $planningRepository->findAllAtelier(),
            'counts'       => $planningRepository->countUsagerByAtelier(),

        ]);
    }

    #[Route('/atelier/{ateliers}', name: 'show_list_usager_par_atelier', methods: ['GET'])]
    public function findUsager(PlanningRepository $planningRepository, Planning $planning, String  $ateliers): Response
    {
        return $this->render('planning/show.listUsager.html.twig', [
            'UsagersByAteliers' => $planningRepository->findUsagerByAtelier($ateliers),
            'planning'    => $planning,

        ]);
    }

    #[Route('/new', name: 'app_planning_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlanningRepository $planningRepository,): Response
    {
        $planning = new Planning();
        $form = $this->createForm(PlanningType::class, $planning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planningRepository->add($planning);
            return $this->redirectToRoute('show_list_usgaer_par_atelier', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('planning/new.html.twig', [
            'planning' => $planning,
            'form' => $form,
        ]);
    }

    #[Route('/atelier/{atelier}/new/usager', name: 'app_planning_new_usager', methods: ['GET', 'POST'])]
    public function newUsager(Request $request, PlanningRepository $planningRepository, Atelier $atelier): Response
    {

        $planning = new Planning();
        $form = $this->createForm(PlanningType::class, $planning, [
            'selected' => $atelier->getId(), 'postes' => $planningRepository->findPosteLibreByAtelier($atelier),
            'usagers' => $planningRepository->findUsagerLibreByAtelier($atelier)
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $planningRepository->add($planning);
            return $this->redirectToRoute('app_planning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planning/new.html.twig', [


            'form'       => $form,
            'atelier'    => $atelier,
            'counts'     => $planningRepository->countUsagerByAtelier(),
            // 'postes'     => $planningRepository->findUsagerByAtelier($atelier),
            'postes'     => $planningRepository->findPosteLibreByAtelier($atelier),
            'usagers'    => $planningRepository->findUsagerLibreByAtelier($atelier),



        ]);
    }

    #[Route('/atelier/{id}', name: 'app_planning_show', methods: ['GET'])]
    public function show(Planning $planning): Response
    {
        return $this->render('planning/show.html.twig', [
            'planning' => $planning,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_planning_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Planning $planning, PlanningRepository $planningRepository): Response
    {
        $form = $this->createForm(PlanningType::class, $planning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planningRepository->add($planning);
            return $this->redirectToRoute('app_planning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planning/edit.html.twig', [
            'planning' => $planning,
            'form' => $form,
        ]);
    }

    #[Route('/atelier/{id}', name: 'app_planning_delete', methods: ['POST'])]
    public function delete(Request $request, Planning $planning, PlanningRepository $planningRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $planning->getId(), $request->request->get('_token'))) {
            $planningRepository->remove($planning);
        }

        return $this->redirectToRoute('app_planning_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/calendrier', name: 'app_calendrier')]
    public function calendrier(PlanningRepository $planningRepository): Response
    {
      
        $donnee = file_get_contents('https://calendrier.api.gouv.fr/jours-feries/metropole/2022.json');
        // $donnee = file_get_contents('../Api_jour_ferie.json');

        $donnees = [];
      
        $ferie = json_decode($donnee, true);
        foreach ($ferie as $key => $valeur) {
            $donnees[] = [
                'start' => $key,
                'title' => $valeur,
            ];
                }
        // $feries = json_encode($donnees);

        $events = $planningRepository->findAll();
        // $rdvs = [];
        foreach ($events as $event) {
            $donnees[] = [
                'id' => $event->getId(),

                'start' => $event->getAteliers()->getstart()->format('Y-m-d H:i:s'),
                'end' => $event->getAteliers()->getend()->format('Y-m-d H:i:s'),
                // 'postes' => $event->getPostes()->getlibelle(),
                'title' => "Atelier:  " . $event->getAteliers()->getLibelle() . " ---- Nom d'usager: " 
                . $event->getUsagers()->getNom() . " " .
                    $event->getUsagers()->getPrenom() . " - " . $event->getPostes()->getlibelle(),
                'backgroundColor' => $event->getAteliers()->getbackgroundColor(),
                'borderColor' => $event->getAteliers()->getBorderColor(),
                'textColor' => $event->getAteliers()->getTextColor()


            ];
        }

        $data =  json_encode($donnees);
       
        return $this->renderForm('planning/calendrier.html.twig', [
            
        'data' => $data,
        // 'ferie' => $feries,

        ]);
    }
}

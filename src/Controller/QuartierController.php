<?php

namespace App\Controller;

use App\Entity\Quartier;
use App\Form\QuartierType;
use App\Repository\QuartierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/quartier')]
class QuartierController extends AbstractController
{
    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/', name: 'app_quartier_index', methods: ['GET'])]
    public function index(QuartierRepository $quartierRepository): Response
    {
        return $this->render('quartier/index.html.twig', [
            'quartiers' => $quartierRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_SUPER_ANIMATEUR')]
    #[Route('/new', name: 'app_quartier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuartierRepository $quartierRepository): Response
    {
        $quartier = new Quartier();
        $form = $this->createForm(QuartierType::class, $quartier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quartierRepository->add($quartier);
            return $this->redirectToRoute('app_quartier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quartier/new.html.twig', [
            'quartier' => $quartier,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/{id}', name: 'app_quartier_show', methods: ['GET'])]
    public function show(Quartier $quartier): Response
    {
        return $this->render('quartier/show.html.twig', [
            'quartier' => $quartier,
        ]);
    }

    #[IsGranted('ROLE_SUPER_ANIMATEUR')]
    #[Route('/{id}/edit', name: 'app_quartier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quartier $quartier, QuartierRepository $quartierRepository): Response
    {
        $form = $this->createForm(QuartierType::class, $quartier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quartierRepository->add($quartier);
            return $this->redirectToRoute('app_quartier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quartier/edit.html.twig', [
            'quartier' => $quartier,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_SUPER_ANIMATEUR')]
    #[Route('/{id}', name: 'app_quartier_delete', methods: ['POST'])]
    public function delete(Request $request, Quartier $quartier, QuartierRepository $quartierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quartier->getId(), $request->request->get('_token'))) {
            $quartierRepository->remove($quartier);
        }

        return $this->redirectToRoute('app_quartier_index', [], Response::HTTP_SEE_OTHER);
    }
}

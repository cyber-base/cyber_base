<?php

namespace App\Controller;

use App\Entity\Animateur;
use App\Form\AnimateurType;
use App\Repository\AnimateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/animateur')]
class AnimateurController extends AbstractController
{
    #[Route('/', name: 'app_animateur_index', methods: ['GET'])]
    public function index(AnimateurRepository $animateurRepository): Response
    {
        return $this->render('animateur/index.html.twig', [
            'animateurs' => $animateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_animateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnimateurRepository $animateurRepository): Response
    {
        $animateur = new Animateur();
        $form = $this->createForm(AnimateurType::class, $animateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animateurRepository->add($animateur);
            return $this->redirectToRoute('app_animateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animateur/new.html.twig', [
            'animateur' => $animateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animateur_show', methods: ['GET'])]
    public function show(Animateur $animateur): Response
    {
        return $this->render('animateur/show.html.twig', [
            'animateur' => $animateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_animateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animateur $animateur, AnimateurRepository $animateurRepository): Response
    {
        $form = $this->createForm(AnimateurType::class, $animateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animateurRepository->add($animateur);
            return $this->redirectToRoute('app_animateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animateur/edit.html.twig', [
            'animateur' => $animateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animateur_delete', methods: ['POST'])]
    public function delete(Request $request, Animateur $animateur, AnimateurRepository $animateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animateur->getId(), $request->request->get('_token'))) {
            $animateurRepository->remove($animateur);
        }

        return $this->redirectToRoute('app_animateur_index', [], Response::HTTP_SEE_OTHER);
    }
}

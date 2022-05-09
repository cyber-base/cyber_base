<?php

namespace App\Controller;

use App\Entity\Animateur;
use App\Form\AnimateurType;
use App\Form\ResetPassType;
use App\Repository\AnimateurRepository;
use Symfony\Component\Mailer\Swift_Mailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Mailer\Mailer;

#[Route('/animateur')]

class AnimateurController extends AbstractController
{
    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/', name: 'app_animateur_index', methods: ['GET'])]
    public function index(AnimateurRepository $animateurRepository): Response
    {
        $genre = $animateurRepository->findAnimateurByGenreFemme();
        return $this->render('animateur/index.html.twig', [
            'animateurs' => $animateurRepository->findAll(),
            'genre' => $genre,
        ]);
    }

    #[IsGranted('ROLE_SUPER_ANIMATEUR')]
    #[Route('/new', name: 'app_animateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnimateurRepository $animateurRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $animateur = new Animateur();
        $form = $this->createForm(AnimateurType::class, $animateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $animateur->setPassword(
            $userPasswordHasher->hashPassword(
                    $animateur,
                    $form->get('plainPassword')->getData()
                )
            );

            $animateurRepository->add($animateur);
            $this->addFlash(
                'success',
                "Animateur ajouté avec succès ."
             );
            return $this->redirectToRoute('app_animateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animateur/new.html.twig', [
            'animateur' => $animateur,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_SUPER_ANIMATEUR')]
    #[Route('/{id}', name: 'app_animateur_show', methods: ['GET'])]
    public function show(Animateur $animateur): Response
    {
        return $this->render('animateur/show.html.twig', [
            'animateur' => $animateur,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/{id}/edit', name: 'app_animateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animateur $animateur, AnimateurRepository $animateurRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(AnimateurType::class, $animateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $animateur->setPassword(
            $userPasswordHasher->hashPassword(
                    $animateur,
                    $form->get('plainPassword')->getData()
                )
            );
            $animateurRepository->add($animateur);
            $this->addFlash(
                'success',
                "Animateur modifié avec succès ."
             );
            return $this->redirectToRoute('app_animateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animateur/edit.html.twig', [
            'animateur' => $animateur,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_SUPER_ANIMATEUR')]
    #[Route('/{id}', name: 'app_animateur_delete', methods: ['POST'])]
    public function delete(Request $request, Animateur $animateur, AnimateurRepository $animateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animateur->getId(), $request->request->get('_token'))) {
            $animateurRepository->remove($animateur);
        }

        return $this->redirectToRoute('app_animateur_index', [], Response::HTTP_SEE_OTHER);
    }



}

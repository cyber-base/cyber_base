<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerType;
use App\Repository\UsagerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



#[Route('/usager')]
class UsagerController extends AbstractController
{
    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/', name: 'app_usager_index', methods: ['GET'])]
    public function index(UsagerRepository $usagerRepository): Response
    {
     return $this->render('usager/index.html.twig', [
            'usagers' => $usagerRepository->findAll(),
       ]);

    }


    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/new', name: 'app_usager_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsagerRepository $usagerRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $usager = new Usager();
        $form = $this->createForm(UsagerType::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $usager->setPassword(
            $userPasswordHasher->hashPassword(
                    $usager,
                    $form->get('plainPassword')->getData()
                )
            );
            $usagerRepository->add($usager);
            $this->addFlash(
                'success',
                "Usager ajouté avec succès ."
             );
            return $this->redirectToRoute('app_usager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usager/new.html.twig', [
            'usager' => $usager,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/{id}', name: 'app_usager_show', methods: ['GET'])]
    public function show(Usager $usager): Response
    {
        return $this->render('usager/show.html.twig', [
            'usager' => $usager,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/{id}/edit', name: 'app_usager_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usager $usager, UsagerRepository $usagerRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(UsagerType::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $usager->setPassword(
            $userPasswordHasher->hashPassword(
                    $usager,
                    $form->get('plainPassword')->getData()
                )
            );
            $usagerRepository->add($usager);
            $this->addFlash(
              'success',
              "Usager modifié avec succès ."
           );
            return $this->redirectToRoute('app_usager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usager/edit.html.twig', [
            'usager' => $usager,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/{id}', name: 'app_usager_delete', methods: ['POST'])]
    public function delete(Request $request, Usager $usager, UsagerRepository $usagerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usager->getId(), $request->request->get('_token'))) {
            $usagerRepository->remove($usager);
        }

        return $this->redirectToRoute('app_usager_index', [], Response::HTTP_SEE_OTHER);
    }

  //  #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/api/usager', name: 'api_usager', methods: ['GET'])]
    public function usagers(UsagerRepository $usagerRepository): Response
    {
        return  $this->json($usagerRepository->findAll(), 200, [], ['groups' => 'usager:read']);

    }

}

<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Planning;
use App\Form\AtelierType;
use App\Repository\AtelierRepository;
use App\Repository\PlanningRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/')]
class AtelierController extends AbstractController
{

    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function home(AtelierRepository $atelierRepository, PlanningRepository $planningRepository): Response
    {
        return $this->render('atelier/home.html.twig', [
            'ateliers' => $atelierRepository->findAll(),
            'counts'       => $planningRepository->countUsagerByAtelier(),
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/liste_atelier', name: 'app_listeAtelier_index', methods: ['GET'])]
    public function index(AtelierRepository $atelierRepository): Response
    {
        return $this->render('atelier/index.html.twig', [
            'ateliers' => $atelierRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/atelier/new', name: 'app_atelier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AtelierRepository $atelierRepository, SluggerInterface $slugger): Response
    {
        $atelier = new Atelier();
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
            } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $atelier->setImage($newFilename);
            }

            $atelierRepository->add($atelier);
              $this->addFlash(
                'success',
                "L'atelier est ajouté avec succes ."
             );
            return $this->redirectToRoute('app_listeAtelier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('atelier/new.html.twig', [
            'atelier' => $atelier,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/atelier/{id}', name: 'app_atelier_show', methods: ['GET'])]
    public function show(Atelier $atelier): Response
    {
        return $this->render('atelier/show.html.twig', [
            'atelier' => $atelier,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/atelier/{id}/edit', name: 'app_atelier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Atelier $atelier, AtelierRepository $atelierRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
            } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $atelier->setImage($newFilename);
            }

            $atelierRepository->add($atelier);
              $this->addFlash(
                'success',
                "L'atelier est modifié avec succès ."
             );
            return $this->redirectToRoute('app_listeAtelier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('atelier/edit.html.twig', [
            'atelier' => $atelier,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ANIMATEUR')]
    #[Route('/atelier/{id}', name: 'app_atelier_delete', methods: ['POST'])]
    public function delete(Request $request, Atelier $atelier, AtelierRepository $atelierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$atelier->getId(), $request->request->get('_token'))) {
            $atelierRepository->remove($atelier);
            $this->addFlash(
                'danger',
                "L'atelier est supprimé avec succès ."
             );
        }

        return $this->redirectToRoute('app_listeAtelier_index', [], Response::HTTP_SEE_OTHER);
    }

    // #[IsGranted('ROLE_SUPER_ANIMATEUR')]
    #[Route('atelier/api/atelier', name: 'atelier', methods: ['GET'])]
    public function usagers(AtelierRepository $atelierRepository): Response
    {
        return  $this->json($atelierRepository->findAll(), 200, [], ['groups' => 'atelier:read']);

    }

    
    #[Route('/calendrier', name: 'app_calendrier', methods: ['GET'])]
    public function calendrier(): Response
    {
 
        return $this->render('planning/calendrier.html.twig', [
            
            // 'calendrier' => $calendrier,
         
        ]);
    }
}

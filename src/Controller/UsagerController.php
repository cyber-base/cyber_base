<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerType;
use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\UsagerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/usager')]
class UsagerController extends AbstractController
{
    #[Route('/', name: 'app_usager_index', methods: ['GET'])]
    public function index(UsagerRepository $usagerRepository): Response
    {
        return $this->render('usager/index.html.twig', [
            'usagers' => $usagerRepository->findAll(),
        ]);
    }
    
    // #[Route('/json', name: 'json', methods: ['GET'])]
    // public function usagers()
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $usagers = $em->getRepository(Usager::class)->findAll();
    //     $datas = array();
    //     foreach($usagers as $key => $usager){
    //         $datas[$key]['nom'] = $usager->getNom();
    //         $datas[$key]['prenom'] = $usager->getPrenom();
    //         $datas[$key]['email'] = $usager->getEmail();
    //         $datas[$key]['adresse'] = $usager->getAdresse();
    //         $datas[$key]['ville'] = $usager->getVille();
    //         $datas[$key]['cp'] = $usager->getCp();

    //     }
    //     return new JsonResponse($datas);
    // }
    
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


    #[Route('/{id}', name: 'app_usager_show', methods: ['GET'])]
    public function show(Usager $usager): Response
    {
        return $this->render('usager/show.html.twig', [
            'usager' => $usager,
        ]);
    }

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
    

    #[Route('/{id}', name: 'app_usager_delete', methods: ['POST'])]
    public function delete(Request $request, Usager $usager, UsagerRepository $usagerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usager->getId(), $request->request->get('_token'))) {
            $usagerRepository->remove($usager);
        }

        return $this->redirectToRoute('app_usager_index', [], Response::HTTP_SEE_OTHER);
    }
    
    
}

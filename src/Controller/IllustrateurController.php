<?php

namespace App\Controller;

use App\Entity\Illustrateur;
use App\Form\IllustrateurType;
use App\Repository\IllustrateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/illustrateur')]
class IllustrateurController extends AbstractController
{
    #[Route('/', name: 'app_illustrateur_index', methods: ['GET'])]
    public function index(IllustrateurRepository $illustrateurRepository): Response
    {
        return $this->render('illustrateur/index.html.twig', [
            'illustrateurs' => $illustrateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_illustrateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $illustrateur = new Illustrateur();
        $form = $this->createForm(IllustrateurType::class, $illustrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($illustrateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_illustrateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('illustrateur/new.html.twig', [
            'illustrateur' => $illustrateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_illustrateur_show', methods: ['GET'])]
    public function show(Illustrateur $illustrateur): Response
    {
        return $this->render('illustrateur/show.html.twig', [
            'illustrateur' => $illustrateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_illustrateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Illustrateur $illustrateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IllustrateurType::class, $illustrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_illustrateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('illustrateur/edit.html.twig', [
            'illustrateur' => $illustrateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_illustrateur_delete', methods: ['POST'])]
    public function delete(Request $request, Illustrateur $illustrateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$illustrateur->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($illustrateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_illustrateur_index', [], Response::HTTP_SEE_OTHER);
    }
}

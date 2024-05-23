<?php

namespace App\Controller;

use App\Entity\Age;
use App\Form\AgeType;
use App\Repository\AgeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/age')]
class AgeController extends AbstractController
{
    // LA ROUTE AFFICHER
    #[Route('/afficher', name: 'app_age_index', methods: ['GET'])]
    public function index(AgeRepository $ageRepository): Response
    {
        return $this->render('age/index.html.twig', [
            'ages' => $ageRepository->findAll(),
        ]);
    }

    // LA ROUTE AJOUTER
    #[Route('/ajouter', name: 'app_age_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $age = new Age();
        $form = $this->createForm(AgeType::class, $age);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($age);
            $entityManager->flush();

            return $this->redirectToRoute('app_age_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('age/new.html.twig', [
            'age' => $age,
            'form' => $form,
        ]);
    }

    // LA FICHE DU FORMULAIRE
    #[Route('/{id}', name: 'app_age_show', methods: ['GET'])]
    public function show(Age $age): Response
    {
        return $this->render('age/show.html.twig', [
            'age' => $age,
        ]);
    }

     // LA ROUTE MODIFIER
    #[Route('/modifier/{id}', name: 'app_age_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Age $age, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AgeType::class, $age);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_age_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('age/edit.html.twig', [
            'age' => $age,
            'form' => $form,
        ]);
    }

    // LA ROUTE SUPPRIMER
    #[Route('/{id}', name: 'app_age_delete', methods: ['POST'])]
    public function delete(Request $request, Age $age, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$age->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($age);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_age_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\AdresseLivraison;
use App\Form\AdresseLivraisonType;
use App\Repository\AdresseLivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profil/adresse/livraison')]
class AdresseLivraisonController extends AbstractController
{   
    // LA ROUTE AFFICHER
    #[Route('/afficher', name: 'app_adresse_livraison_index', methods: ['GET'])]
    public function index(AdresseLivraisonRepository $adresseLivraisonRepository): Response
    {
        return $this->render('adresse_livraison/index.html.twig', [
            'adresse_livraisons' => $adresseLivraisonRepository->findAll(),
        ]);
    }

    // LA ROUTE AJOUTER
    #[Route('/ajouter', name: 'app_adresse_livraison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresseLivraison = new AdresseLivraison();
        $form = $this->createForm(AdresseLivraisonType::class, $adresseLivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adresseLivraison);
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_livraison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse_livraison/new.html.twig', [
            'adresse_livraison' => $adresseLivraison,
            'form' => $form,
        ]);
    }

     // LA FICHE DU FORMULAIRE
    #[Route('/{id}', name: 'app_adresse_livraison_show', methods: ['GET'])]
    public function show(AdresseLivraison $adresseLivraison): Response
    {
        return $this->render('adresse_livraison/show.html.twig', [
            'adresse_livraison' => $adresseLivraison,
        ]);
    }

    // LA ROUTE MODIFIER
    #[Route('/modifier/{id}', name: 'app_adresse_livraison_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdresseLivraison $adresseLivraison, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdresseLivraisonType::class, $adresseLivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_livraison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse_livraison/edit.html.twig', [
            'adresse_livraison' => $adresseLivraison,
            'form' => $form,
        ]);
    }

     // LA ROUTE SUPPRIMER
    #[Route('/{id}', name: 'app_adresse_livraison_delete', methods: ['POST'])]
    public function delete(Request $request, AdresseLivraison $adresseLivraison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresseLivraison->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($adresseLivraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adresse_livraison_index', [], Response::HTTP_SEE_OTHER);
    }
}

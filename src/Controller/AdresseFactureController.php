<?php

namespace App\Controller;

use App\Entity\AdresseFacture;
use App\Form\AdresseFactureType;
use App\Repository\AdresseFactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profil/adresse/facture')]
class AdresseFactureController extends AbstractController
{
     // LA ROUTE AFFICHER
    #[Route('/afficher', name: 'app_adresse_facture_index', methods: ['GET'])]
    public function index(AdresseFactureRepository $adresseFactureRepository): Response
    {
        return $this->render('adresse_facture/index.html.twig', [
            'adresse_factures' => $adresseFactureRepository->findAll(),
        ]);
    }

    // LA ROUTE AJOUTER
    #[Route('/ajouter', name: 'app_adresse_facture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresseFacture = new AdresseFacture();
        $form = $this->createForm(AdresseFactureType::class, $adresseFacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adresseFacture);
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse_facture/new.html.twig', [
            'adresse_facture' => $adresseFacture,
            'form' => $form,
        ]);
    }

     // LA FICHE DU FORMULAIRE
    #[Route('/{id}', name: 'app_adresse_facture_show', methods: ['GET'])]
    public function show(AdresseFacture $adresseFacture): Response
    {
        return $this->render('adresse_facture/show.html.twig', [
            'adresse_facture' => $adresseFacture,
        ]);
    }

     // LA ROUTE MODIFIER
    #[Route('/modifier/{id}', name: 'app_adresse_facture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdresseFacture $adresseFacture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdresseFactureType::class, $adresseFacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse_facture/edit.html.twig', [
            'adresse_facture' => $adresseFacture,
            'form' => $form,
        ]);
    }
    
     // LA ROUTE SUPPRIMER
    #[Route('/{id}', name: 'app_adresse_facture_delete', methods: ['POST'])]
    public function delete(Request $request, AdresseFacture $adresseFacture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresseFacture->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($adresseFacture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adresse_facture_index', [], Response::HTTP_SEE_OTHER);
    }
}

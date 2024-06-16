<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/livre')]
class LivreController extends AbstractController
{
      // LA ROUTE AFFICHER
    #[Route('/afficher', name: 'app_livre_index', methods: ['GET'])]
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
        ]);
    }

    // LA ROUTE AJOUTER
    #[Route('/ajouter', name: 'app_livre_new', methods: ['GET', 'POST'])]
    //Pour traiter un formulaire il faut récupérer la requête qui a été généré à l'envoi du formulaire, pour cela dans la fonction publique on met en argument "request", pour gérer le stockage en bdd on met l'EntityManagerInterface et un 3 ème argument on peut mettre un SluggerInterface
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // création d'un objet
        $livre = new Livre();

        // création du formulaire
        $form = $this->createForm(LivreType::class, $livre);
        

        //ici on traite le formulaire
        $form->handleRequest($request);

        //on vérifie que le formulaire est soumis ET valide
        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('couv1')->getData();
            
            if($imageFile){

                $nomImage= date('YmdHis').'-'.uniqid().'-'.$imageFile->getClientOriginalName();
                //$nomImage = date(YmdHis).'-'.uniquid().'-'.$imageFile->getClientOriginalExtension();
                $imageFile->move(
                    $this->getParameter('couv1'),
                    $nomImage
                );

                $livre->setCouv1($nomImage);
            }

            $imageFile4 = $form->get('couv4')->getData();
            if ($imageFile4) {
                $nomImage4 = date('YmdHis').'-'.uniqid().'-'.$imageFile4->getClientOriginalName();
                $imageFile4->move(
                    $this->getParameter('couv4'),
                    $nomImage4
                );
                $livre->setCouv4($nomImage4);
            }
            // On stocke
            $entityManager->persist($livre);
            $entityManager->flush();

            // On redirige vers
            return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }
    
    // LA FICHE DU FORMULAIRE
    #[Route('/{id}', name: 'app_livre_show', methods: ['GET'])]
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }

     // LA ROUTE MODIFIER
    #[Route('/modifier/{id}', name: 'app_livre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    // LA ROUTE SUPPRIMER
    #[Route('/{id}', name: 'app_livre_delete', methods: ['POST'])]
    public function delete(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->getPayload()->get('_token'))) {

            if ($livre->getCouv1()){
                unlink($this->getParameter('livre'). $livre->getCouv1());
            }
    
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Entity\LigneCommande;
use App\Repository\LivreRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/profil/commande', name:'app_commande_')]
class CommandeController extends AbstractController
{
    // LA ROUTE AFFICHER
    #[Route('/afficher', name: 'app_commande_index', methods: ['GET'])]
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }

     // LA ROUTE AJOUTER
    #[Route('/ajouter', name: 'add')]
    public function add(SessionInterface $session, LivreRepository $livreRepository, EntityManagerInterface $entityManager): Response
    {

    $this->denyAccessUnlessGranted('ROLE_USER');

    $panier = $session->get('panier', []);

    if($panier === []){
        $this->addFlash('message', 'Votre panier est vide 😭.');
        return $this->redirectToRoute('home');
    }

    //Le panier n'est pas vide, on crée la commande
    $commande = new Commande();

    // On remplit la commande
    $commande->setUsers($this->getUser());
    $commande->setReference(uniqid());

    // On parcourt le panier pour créer les détails de commande
    foreach($panier as $item => $quantite){
        $ligneCommande = new LigneCommande();

        // On va chercher le produit
        $livre = $livreRepository->find($item);
        
        $prix = $livre->getPrix();

        // On crée le détail de commande
        $ligneCommande->setQuantite($quantite);
        $ligneCommande->setPrix($prix);
       

        $commande->addligneCommande($ligneCommande);
    }

    // On persiste et on flush
    $em->persist($commande);
    $em->flush();

    $session->remove('panier');

    $this->addFlash('message', ' Fantastic ☆*: .｡. o(≧▽≦)o .｡.:*☆ ! Vous recevrez vos livres dans quelques jours !');
    return $this->redirectToRoute('home');
}
}
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/panier')]
class PanierController extends AbstractController
{
    #[Route('', name: 'app_panier')]
    public function index(SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);
        dump($panier);

        return $this->render('panier/index.html.twig', [
            
        ]);
    }

    
    #[Route('/ajouter', name: 'app_panier_new')]
    public function add(Request $request, SessionInterface $session): Response
    {
        $produitId = $request->request->get('produit');
        $quantite = $request->request->get('quantite');
    
        $panier = $session->get('panier', []);
        
        if (isset($panier[$produitId])) {
            $panier[$produitId] += $quantite;
        } else {
            $panier[$produitId] = $quantite;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier');

        }




}




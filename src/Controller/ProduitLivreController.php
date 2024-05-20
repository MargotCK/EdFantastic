<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitLivreController extends AbstractController
{
    #[Route('/produit/livre', name: 'app_produit_livre')]
    public function index(): Response
    {
        return $this->render('produit_livre/index.html.twig', [
            'controller_name' => 'ProduitLivreController',
        ]);
    }
}

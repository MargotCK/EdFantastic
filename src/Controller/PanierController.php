<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin/panier')]
class PanierController extends AbstractController
{
    // LA ROUTE AJOUTER
    #[Route('/ajouter', name: 'app_panier_new')]
    public function new(Livre $livre, SessionInterface $session): Response
    {
        return $this->render('panier/new.html.twig', [
            
        ]);
    }
}

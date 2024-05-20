<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NavigationController extends AbstractController
{
    #les routes de la barre des menus#
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('navigation/index.html.twig', []);
    }

    #[Route('/univers', name:'univers')]

    public function univers(): Response
    {
    
        return $this->render('navigation/univers.html.twig',[]);
    }

    #[Route('/nosLivres', name:'books')]
    public function nosLivres(): Response
    {
        return $this->render('navigation/noslivres.html.twig', []);
    }

    #[Route('/nosAuteurs', name:'nosAuteurs')]
    public function nosAuteurs(): Response
    {
        return $this->render('navigation/nosAuteurs.html.twig',[]);
    }

    #[Route('/nosIllustrateurs', name:'nosIllustrateurs')]
    public function nosIllustrateurs(): Response
    {
        return $this->render('navigation/nosIllustrateurs.html.twig',[]);
    }

    #les routes du dropdown "nosLivres"#
    #[Route('/age', name:'ageName')]
    public function age(): Response
    {
        return $this->render('navigation/age.html.twig',[]);
    }

    #[Route('/serie', name:'serieName')]
    public function serie(): Response
    {
        return $this->render('navigation/serie.html.twig',[]);
    }

    #[Route('/theme', name:'themeName')]
    public function theme(): Response
    {
        return $this->render('navigation/theme.html.twig',[]);

    }
    #[Route('/genre', name:'genreName')]
    public function genre():Response
    {
        return $this->render('navigation/genre.html.twig',[]);
    }

}

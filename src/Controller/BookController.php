<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/book/{id}')]
class BookController extends AbstractController
{
    #[Route('/detail', name: 'app_book')]
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'livres'=>$livreRepository->findAll()
        ]);
    }
}

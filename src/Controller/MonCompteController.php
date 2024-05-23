<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('profil/mon/compte')]
class MonCompteController extends AbstractController
{
    // ROUTE AFFICHER
    #[Route('/', name: 'app_mon_compte')]
    public function index(): Response
    {
        return $this->render('mon_compte/index.html.twig', [
    
        ]);
    }

    // ROUTE MODIFIER
    #[Route('/modifier', name: 'app_mon_compte_edit')]
    public function modifier(): Response
    {
        $user =$this->getUser();
        $form = $this->createForm(RegistrationFormType::class, $user);

        return $this->render('mon_compte/edit.html.twig', [
            'form'=> $form->createView()
        ]);
    }
}

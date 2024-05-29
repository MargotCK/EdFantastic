<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
   

    #[Route('/stripe', name: 'app_stripe', methods:['GET'])]
    public function index(SessionInterface $session, LivreRepository $livreRepository): Response
    {
        $panier = $session->get('panier', []);

        dump($panier);

        $montant = 0;

        foreach($panier as $k => $v){
            //$k (cad la l'id) est la clé  et $v (la quantité) c'est la valeur
            $produit = $livreRepository->find($k);
            //Je multiplie par 100 pour mettre le prix en centime puis je mutiplie par la quantité
            $montant += ($produit->getPrix() * 100) * $v;
        }

        
        $stripePublicKey = $_ENV['STRIPE_PUBLIC_KEY'];

        return $this->render('stripe/index.html.twig', [
            'stripe_public_key' => $stripePublicKey,
            'montant' => $montant
        ]);
    }

    

    #[Route('/process_payment', name: 'process_payment', methods:['GET'])]
    public function process_payment(SessionInterface $session, LivreRepository $livreRepository)
    {
        $stripeSecretKey = $_ENV['STRIPE_SECRET_KEY'];
        Stripe::setApiKey($stripeSecretKey);
        
        $token =$request->request->get('stripeToken');

        try{
            $charge =Charge::create([
                'amount' => $this->getMontantTotal(),
                'currency' => 'eur',
                'description' => 'Achat effectué sur Editions Fantastic',
                'source' => $token
            ]);

            $stripeChargeId = $charge->id;

            return $this->redirectToRoute('payment_success');
        }catch (\Exception $e){
            return $this->redirectToRoute('payment_fail');
        }
    }

        
    #[Route('/payment_success', name: 'payment_success', methods:['GET'])]
    public function payment_success():Response
    {
        // sur cette route il faudra faire new commande en utlisant un foreach et détailCommande 
        //soustraire les stocks
        //vider le panier
    
        return $this->render('stripe/payment_success.html.twig');

    }

        #[Route('/payment_fail', name: 'payment_fail', methods:['GET'])]
    public function payment_fail():Response
    {
        return $this->render('stripe/payment_fail.html.twig');
    }

   

}

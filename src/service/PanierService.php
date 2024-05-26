<?php

namespace App\Service;

use App\Entity\Livre;
use App\Entity\Commande;
use App\Entity\LigneDeCommande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class PanierService
{
    private $session;
    private $entityManager;
    private $security;

    public function __construct(SessionInterface $session, EntityManagerInterface $entityManager, Security $security)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function ajouterLivre(Livre $livre, int $quantite)
    {
        $panier = $this->session->get('panier', []);
        $id = $livre->getId();

        if (!empty($panier[$id])) {
            $panier[$id]['quantite'] += $quantite;
        } else {
            $panier[$id] = [
                'quantite' => $quantite,
                'prix' => $livre->getPrix(),
            ];
        }

        $this->session->set('panier', $panier);
    }

    public function retirerLivre(Livre $livre)
    {
        $panier = $this->session->get('panier', []);
        $id = $livre->getId();

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
    }

    public function getPanier()
    {
        return $this->session->get('panier', []);
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getPanier() as $item) {
            $total += $item['quantite'] * $item['prix'];
        }
        return $total;
    }

    public function sauvegarderCommande()
    {
        $user = $this->security->getUser();
        if (!$user) {
            throw new \Exception('Utilisateur non connecté');
        }

        $commande = new Commande();
        $commande->setUser($user);
        $commande->setDateCommande(new \DateTime());
        $this->entityManager->persist($commande);

        foreach ($this->getPanier() as $id => $item) {
            $livre = $this->entityManager->getRepository(Livre::class)->find($id);
            $ligneDeCommande = new LigneDeCommande();
            $ligneDeCommande->setCommande($commande);
            $ligneDeCommande->setQuantite($item['quantite']);
            $ligneDeCommande->setPrixTTC($item['prix']);
            $this->entityManager->persist($ligneDeCommande);
            $commande->addLivre($livre);
        }

        $this->entityManager->flush();
        $this->session->remove('panier');
    }
}




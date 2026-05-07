<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {

        // Données statiques correspondant à ton image Figma
        $stats = [
            [
                'label' => 'Chiffre d\'affaires (Payé)',
                'value' => '2 250 €',
                'icon' => '€',
                'color' => 'green'
            ],
            [
                'label' => 'Factures en attente de paiement',
                'value' => '1',
                'icon' => '📄',
                'color' => 'orange'
            ],
            [
                'label' => 'Total Clients',
                'value' => '2',
                'icon' => '👥',
                'color' => 'blue'
            ],
            [
                'label' => 'Total Produits',
                'value' => '3',
                'icon' => '📦',
                'color' => 'purple'
            ],
        ];

        return $this->render('dashboard/index.html.twig', [
            'stats' => $stats,
        ]);
    }
}

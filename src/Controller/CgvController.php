<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CgvController extends AbstractController
{
    #[Route('/cgv/template/{type}', name: 'app_cgv_template')]
    public function getTemplate(string $type): JsonResponse
    {

        $allowed = [
            'auto',
            'association',
            'sa',
            'sas',
            'sarl',
            'eurl'
        ];

        if (!in_array($type, $allowed)) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Template introuvable'
            ], 404);
        }

        $filePath = $this->getParameter('kernel.project_dir')
            . "/templates/cgv/{$type}.txt";

        if (!file_exists($filePath)) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Fichier manquant'
            ], 404);
        }

        return new JsonResponse([
            'success' => true,
            'content' => file_get_contents($filePath)
        ]);
    }
}
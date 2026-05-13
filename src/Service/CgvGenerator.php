<?php

namespace App\Service;

use App\Entity\User;
use Twig\Environment;

class CgvGenerator
{
    public function __construct(
        private Environment $twig
    ) {}

    public function generate(User $user): string
    {
        $template = match ($user->getCompanyType()) {

            'association' => 'cgv/association.txt.twig',
            'sarl' => 'cgv/sarl.txt.twig',
            'sas' => 'cgv/sas.txt.twig',
            'sa' => 'cgv/sa.txt.twig',
            'eurl' => 'cgv/eurl.txt.twig',
            'auto' => 'cgv/auto.txt.twig',

            default => null,
        };

        if (!$template) {
            return '';
        }

        return $this->twig->render($template, [
            'user' => $user
        ]);
    }
}
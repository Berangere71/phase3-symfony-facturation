<?php

namespace App\Service;

use App\Entity\User;

class CgvGenerator
{
    public function generate(User $user): string
    {
        return match ($user->getCompanyType()) {

            'auto_entrepreneur' => $this->autoEntrepreneur(),

            'association' => $this->association(),

            'eurl' => $this->eurl(),

            'sarl' => $this->sarl(),

            'sas' => $this->sas(),
            
            'sa' => $this->sa(),

            default => '',
        };
    }

    private function autoEntrepreneur(): string
    {
        return "CGV AUTO-ENTREPRENEUR";
    }

    private function association(): string
    {
        return "CGV ASSOCIATION";
    }

    private function eurl(): string
    {
        return "CGV EURL";
    }

    private function sarl(): string
    {
        return "CGV SARL";
    }

    private function sas(): string
    {
        return "CGV SAS / SASU";
    }

    private function sa(): string
    {
        return "CGV SA";
    }
}
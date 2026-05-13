<?php

namespace App\Controller;

use App\Form\ProfileFormType;
use App\Service\CgvGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        CgvGenerator $cgvGenerator
    ): Response {

        $user = $this->getUser();

        $form = $this->createForm(
            ProfileFormType::class,
            $user
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /*
            Génération automatique CGV
            */

            if ($user->getCompanyType()) {

                $user->setCgv(
                    $cgvGenerator->generate($user)
                );
            }

            /*
            Génération automatique SIREN
            */

            if ($user->getSiret()) {

                $siret = preg_replace(
                    '/\s+/',
                    '',
                    $user->getSiret()
                );

                if (strlen($siret) === 14) {

                    $user->setSiren(
                        substr($siret, 0, 9)
                    );
                }
            }

            $em->flush();

            $this->addFlash(
                'success',
                'Profil mis à jour avec succès.'
            );

            return $this->redirectToRoute(
                'app_profile'
            );
        }

        return $this->render(
            'profile/index.html.twig',
            [
                'profileForm' => $form,
            ]
        );
    }

    #[Route('/profile/delete', name: 'app_profile_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        EntityManagerInterface $em
    ): Response {

        $user = $this->getUser();

        if (!$user) {

            return $this->redirectToRoute(
                'app_login'
            );
        }

        if (
            $this->isCsrfTokenValid(
                'delete_account',
                $request->request->get('_token')
            )
        ) {

            $this->container
                ->get('security.token_storage')
                ->setToken(null);

            $request->getSession()->invalidate();

            $em->remove($user);

            $em->flush();

            $this->addFlash(
                'success',
                'Compte supprimé.'
            );

            return $this->redirectToRoute(
                'app_register'
            );
        }

        return $this->redirectToRoute(
            'app_profile'
        );
    }
}
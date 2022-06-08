<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class UtilisateurParUid extends AbstractController
{
 
    public function __invoke(string $uid)
    {
        $utilisateur = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy(
                ['uid' => $uid],
            );

        if (!$utilisateur) {
            throw $this->createNotFoundException(
                'No user found for this uid'
            );
        }

        return $utilisateur;
    }
}

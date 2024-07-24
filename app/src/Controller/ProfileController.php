<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function show(User $user, MicroPostRepository $posts): Response
    {
        return $this->render('profile/show.html.twig', [
            'user' => $user,
            // 'posts' => $posts->findAllByAuthor(
            //     $user
            // )
        ]);
    }
}

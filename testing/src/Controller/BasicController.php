<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasicController extends AbstractController
{
    #[Route('/protected', name: 'secure_protected')]
    public function secure(): JsonResponse
    {
        return $this->json([
            'message' => 'You are in secure area!',
        ]);
    }

    #[Route('/private', name: 'secure_private')]
    public function another(): JsonResponse
    {
        return $this->json([
            'message' => 'You are also in secure area!',
        ]);
    }

    #[Route('/public', name: 'secure_public')]
    public function public(): JsonResponse
    {
        return $this->json([
            'message' => 'This is public area!',
        ]);
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(): JsonResponse
    {
        return $this->json([
            'message' => 'This is dashboard !!',
        ]);
    }

    #[Route('/test', name: 'app_test')]
    public function test(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'BasicController',
            'values' => ['test1', 'test2', 'test3'],
        ]);
    }
}
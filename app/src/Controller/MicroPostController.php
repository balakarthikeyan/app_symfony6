<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post-testing', name: 'app_micro_post_testing')]
    public function testing(MicroPostRepository $posts): Response
    {
        // $microPost = new MicroPost();
        // $microPost->setTitle('It comes from controller');
        // $microPost->setText('Hi!');
        // $microPost->setCreated(new \DateTime());
        // $posts->add($microPost, true);

        // $microPost = $posts->find(4);
        // $microPost->setText('Welcome to controller update');
        // $posts->add($microPost, true);

        // $microPost = $posts->find(4);
        // $posts->remove($microPost, true);

        // dd($posts->findAll()); // To get all records
        // dd($posts->find(3)); // To get by primary id
        // dd($posts->findOneBy(['title' => 'Welcome to US!'])); // To get by any field with one record
        // dd($posts->findBy(['title' => 'Welcome to US!'])); // To get by any field with more record

        dd($posts);
    }

    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        return $this->render(
            'micro_post/index.html.twig',
            [
                'posts' => $posts->findAll(),
            ]
        );
    }

    #[Route('/micro-post-repo/{id}', name: 'app_micro_post_repo')]
    public function showbyOne($id, MicroPostRepository $post): Response
    {
        dd($post->find($id));
    }

    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render(
            'micro_post/show.html.twig',
            [
                'post' => $post,
            ]
        );
    }

}

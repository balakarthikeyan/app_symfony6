<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function add(Request $request, MicroPostRepository $posts): Response
    {
        // $form = $this->createFormBuilder(new MicroPost())
        //     ->add('title')
        //     ->add('text')
        //     ->getForm();

        $form = $this->createForm(MicroPostType::class, new MicroPost());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated(new \DateTime());
            $posts->add($post, true);

            // Add a flash
            $this->addFlash('success', 'Your micro post have been addded.');
            // Redirect
            return $this->redirectToRoute('app_micro_post');

        } 

        return $this->render(
            'micro_post/add.html.twig',
            [
                'form' => $form
            ]
        );
    }

    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]
    public function edit(MicroPost $post, Request $request, MicroPostRepository $posts): Response
    {
        $form = $this->createFormBuilder($post)
            ->add('title')
            ->add('text')
            ->add('submit', SubmitType::class, ['label' => 'Update'])
            ->getForm();

        // $form = $this->createForm(MicroPostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $posts->add($post, true);

            // Add a flash
            $this->addFlash('success', 'Your micro post have been updated.');

            return $this->redirectToRoute('app_micro_post');
            // Redirect
        }

        return $this->render(
            'micro_post/edit.html.twig',
            [
                'form' => $form
            ]
        );
    }
}

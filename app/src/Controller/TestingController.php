<?php
namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\UserProfile;
use App\Form\MicroPostType;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestingController extends AbstractController
{

    #[Route('/testing', name: 'app_testing')]
    public function testing(MicroPostRepository $posts, UserProfileRepository $profiles, CommentRepository $comments): Response
    {
        // Add Micropost

        // $microPost = new MicroPost();
        // $microPost->setTitle('It comes from controller');
        // $microPost->setText('Hi!');
        // $microPost->setCreated(new DateTime());
        // $posts->add($microPost, true);

        // Find & Update Micropost

        // $microPost = $posts->find(4);
        // $microPost->setText('Welcome to controller update');
        // $posts->add($microPost, true);

        // Find & remove Micropost

        // $microPost = $posts->find(4);
        // $posts->remove($microPost, true);

        // Find Methods

        // dd($posts->findAll()); // To get all records
        // dd($posts->find(3)); // To get by primary id
        // dd($posts->findOneBy(['title' => 'Welcome to US!'])); // To get by any field with one record
        // dd($posts->findBy(['title' => 'Welcome to US!'])); // To get by any field with more record

        // Add Post with Comment

        // $post = new MicroPost();
        // $post->setTitle('It comes from Testing 7');
        // $post->setText('It comes from Testing description 7');
        // $post->setCreated(new DateTime());
        // // $posts->add($post, true); // If cascade: ['persist'] not added in Entity
        // $comment = new Comment();
        // $comment->setText('Comment Hello 7');
        // $post->addComment($comment);
        // $comments->add($comment, true);

        // Add Comment by Post

        $post = $posts->find(4);
        $comment = new Comment();
        $comment->setText('Comment Hello 01');
        $comment->setPost($post);
        $comment->setAuthor($post->getAuthor());
        $comments->add($comment, true);

        // Delete Comment by Post

        // $post = $posts->find(4);
        // $comment = $post->getComments()[2];
        // $post->removeComment($comment);
        // $posts->add($post, true);

        // $post = $posts->find(4);
        // $comment = $post->getComments()[2];
        // $comment->setPost(null);
        // $comments->add($comment, true);

        // Add User with UserProfile

        // $user = new User();
        // $user->setEmail('email1@symfony6.com');
        // $user->setPassword('12345678');
        // $profile = new UserProfile();
        // $profile->setUser($user);
        // $profiles->add($profile, true);
        // dd($user);

        // $profile = $profiles->find(1);
        // $profiles->remove($profile, true);
        // dd($profile);
        
        return $this->render(
            'testing/index.html.twig',
            []
        );

    }
}
<?php
namespace App\Controller;

use App\Entity\Quote;
use App\Form\QuoteType; 
use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuoteController extends AbstractController
{
    #[Route('/quote', name: 'quote')]
    public function index(  QuoteRepository $quoteRepository ): Response
    {
        return $this->render('quote/index.html.twig', [
            'controller_name' => 'QuoteController',
            'quotes' => $quoteRepository->findAll(),
        ]);
    }

    #[Route('/form', name: 'form')] 
    public function form( Request $request, QuoteRepository $quoteRepository ): Response
    {
        $quote = new Quote();
        // $form = $this->createFormBuilder($quote)
        // ->add ('quote', TextareaType::class, array ('label' => 'Quote ', 'attr' => array ('class' => 'form-control')))
        // ->add ('historian', TextType::class, array ('label' => 'Historian ', 'required' => false, 'attr' => array ('class' => 'form-control' )))
        // ->add ('year', TextType::class, array ('label' => 'Year ', 'required' => false, 'attr' => array ('class' => 'form-control' )))
        // ->add ('save', SubmitType::class, array ('label' => 'Create ', 'attr' => array ('class' => 'btn btn-primary mt-3')))
        // ->getForm();

        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $data   = $form->getData(); print_r($data); die();
            $quoteRepository->save($quote, true);
            return $this->redirectToRoute('quote', [], Response::HTTP_SEE_OTHER);
        }
        
        // Using createFormBuilder
        // return $this->render('quote/_form.html.twig', [ 
        //     'controller_name' => 'QuoteController', 
        //     'form' => $form->createView() 
        // ]);

        // Using createForm
        return $this->renderForm('quote/form.html.twig', [
            'controller_name' => 'QuoteController', 
            'form' => $form,
        ]);
    }

}

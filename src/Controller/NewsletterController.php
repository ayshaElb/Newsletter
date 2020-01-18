<?php

namespace App\Controller;

use App\Service\Mailer;
use App\Entity\Subscriber;
use App\Form\SubscriberType;
use App\Repository\TypeNewsletterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterController extends AbstractController
{
    
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    
    /**
     * @Route("/", name="subscribe")
     */
    public function subscribe(Request $request): Response
    {
        
        $subscriber = new Subscriber();
        $form = $this->createForm(SubscriberType::class, $subscriber);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscriber);
            $entityManager->flush();

            //send a confirmation 
            
            $this->mailer->sendEmail(  
                $subscriber->getEmail(), 
                'Abonnement aux newsletters',
                $this->renderView(
                    'emails/registration.html.twig',
                    ['subscriber' => $subscriber]
                ),
                'societe@societe.com',
                              
                
            );

            $this->addFlash(
                'success',
                'Vous avez été inscrit avec succès à la Newsletter, vous aller recevoir un email de confirmation !'
            );
        }

        return $this->render('newsletter/index.html.twig', [
             
            'form' => $form->createView(),         
        ]);
    }

    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function show(TypeNewsletterRepository $typeNewsletterRepository, Request $request): Response
    {
        $newsletters = $typeNewsletterRepository->findAll();

                
        return $this->render('/newsletter/show.html.twig', [
            'newsletters' => $newsletters,
            
        ]);
    }
    

    /**
    * @Route("/subscriber/{id}", name="subscriber", methods={"GET", "POST"})
    */
    public function subscription(Subscriber $subscriber)
    {
        return $this->render('subscriber/show.html.twig', [
            'subscriber' => $subscriber,
        ]);
    }

    /**
    * @Route("/delete", name="delete", methods={"POST"})
    */
    public function delete()
    {
        
    }
    
}

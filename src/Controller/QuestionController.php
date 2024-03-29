<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Questions;
use App\Repository\QuestionsRepository;
use App\Form\QuestionType;
use App\Form\QuestionAddType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{

    private $questionsRepository;

    public function __construct(private ManagerRegistry $doctrine, QuestionsRepository $questionsRepository) 
    {
        $this->questionsRepository = $questionsRepository;
    }

    /**
     * Modification d'une question
     * 
     * @param   int     $id     Identifiant de l'article
     * 
     * @return Response
     */

    public function edit( Request $request, int $id, ManagerRegistry $doctrine): Response
    {
        $formData = new Questions();
        // Récupération de la question à modifier
        $question = $this->questionsRepository->find($id);
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);
        // Traitement du formulaire
        if ($form->isSubmitted() && $form->isValid())
        {
            // ... (mise à jour des données de la question)
            $formData->setQuestion($form->get('question')->getData());
            $formData->setEnjeuEFC($form->get('enjeu_efc')->getData());
            $formData->setEnjeuEIT($form->get('enjeu_eit')->getData());
            $formData->setEnjeuEC($form->get('enjeu_ec')->getData());

            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }



 



    /**
     * Ajout d'une question
     * 
     * @param   int     $id     Identifiant de l'article
     * 
     * @return Response
     */

    public function add(EntityManagerInterface $manager, Request $request, ManagerRegistry $doctrine): Response
    {
        $formData = new Questions();

        $form = $this->createForm(QuestionAddType::class, $formData);
        $form->handleRequest($request);


        // Traitement du formulaire
        if ($form->isSubmitted() && $form->isValid())
        {
            // ... (création de la nouvelle question)
            $formData->setQuestion($form->get('question')->getData());
            $formData->setEnjeuEFC($form->get('enjeu_efc')->getData());
            $formData->setEnjeuEIT($form->get('enjeu_eit')->getData());
            $formData->setEnjeuEC($form->get('enjeu_ec')->getData());
            
            $manager->persist($formData);
            $manager->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('question/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
 


    /**
     * Supprimer une question
     * 
     * @param   int     $id     Identifiant de la question
     * 
     * @return Response
     */
    public function remove(int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $question = $entityManager->getRepository(Questions::class)->findBy(['id' => $id])[0];

 
        // La question est supprimée
        $entityManager->remove($question);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
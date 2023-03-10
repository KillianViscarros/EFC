<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\QuestionsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\QuestionType;
use App\Entity\Questions;

class HomeController extends AbstractController
{
    /**
     * page d'accueil
     * 
     * @return Response
     */
    public function index(QuestionsRepository $questionsRepository): Response
    {




        return $this->render('home/index.html.twig', [
            'questions' => $questionsRepository->findAll(),
            'questions' => $questionsRepository->findBy(array(), array('id' => 'desc')),
        ]);
    }



   
}
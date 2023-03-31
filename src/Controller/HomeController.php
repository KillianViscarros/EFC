<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\QuestionsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\QuestionType;
use App\Entity\Questions;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * page d'accueil
     * 
     * @return Response
     */
    public function index(QuestionsRepository $questionsRepository, Request $request): Response
    {

        
        $questions = $questionsRepository->findAll();
        $totalEFC = 0;
        $totalEIT = 0;
        $totalEC = 0;

        $totalEnjeuxEFC = 0;
        $totalEnjeuxEIT = 0;
        $totalEnjeuxEC = 0;

        
        if ($request->isMethod('POST')) {
            foreach ($questions as $idquestion) {
                if ($idquestion->getEnjeuefc() >=0 ) {

                    $value = $request->request->get('question_'.$idquestion->getId(), 0);
                    $totalEFC += ($value * $idquestion->getEnjeuefc())*100;
                    $totalEnjeuxEFC += $idquestion->getEnjeuefc();
                }
                if ($idquestion->getEnjeueit() >=0) {

                    $value = $request->request->get('question_'.$idquestion->getId(), 0);
                    $totalEIT += ($value * $idquestion->getEnjeueit())*100;
                    $totalEnjeuxEIT += $idquestion->getEnjeueit();
                   
                }
                if ($idquestion->getEnjeuec() >=0 ) {
                    $value = $request->request->get('question_'.$idquestion->getId(), 0);
                    $totalEC += ($value * $idquestion->getEnjeuec())*100;
                    $totalEnjeuxEC += $idquestion->getEnjeuec();
                   
                }
            }
            $totalEnjeux = $totalEnjeuxEFC + $totalEnjeuxEIT + $totalEnjeuxEC;
            $totalEFC = $totalEFC / ($totalEnjeuxEFC * 3);
            $totalEIT = $totalEIT / ($totalEnjeuxEIT * 3);
            $totalEC = $totalEC / ($totalEnjeuxEC * 3);
        }



        return $this->render('home/index.html.twig', [
            'questions' => $questionsRepository->findAll(),
            'idquestions' => $questionsRepository->findBy(array(), array('id' => 'desc')),
            'totalEFC' => $totalEFC,
            'totalEIT' => $totalEIT,
            'totalEC' => $totalEC,
        ]);
    }


   
}
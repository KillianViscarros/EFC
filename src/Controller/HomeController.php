<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\QuestionsRepository;
use App\Repository\ScoreRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\QuestionType;
use App\Entity\Questions;
use App\Entity\User;
use App\Entity\Score;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends AbstractController
{
    /**
     * page d'accueil
     * 
     * @return Response
     */
    public function index(QuestionsRepository $questionsRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        
        $questions = $questionsRepository->findAll();
        $totalEFC = 0;
        $totalEIT = 0;
        $totalEC = 0;

        $totalEnjeuxEFC = 0;
        $totalEnjeuxEIT = 0;
        $totalEnjeuxEC = 0;

        
        if ($request->isMethod('POST')) {
            $entreprise = $request->request->get('entreprise');
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
            $totalEFC = ceil($totalEFC / ($totalEnjeuxEFC * 3));
            $totalEIT = ceil($totalEIT / ($totalEnjeuxEIT * 3));
            $totalEC = ceil($totalEC / ($totalEnjeuxEC * 3));
            $total = ceil(($totalEFC + $totalEIT + $totalEC) / 3);




            $score = new Score();
            $score->setEntreprise($entreprise);
            $score->setEfc($totalEFC);
            $score->setEit($totalEIT);
            $score->setEc($totalEC);
            $score->setTotal($total);
        
            // Récupérer l'utilisateur connecté
            $user = $this->getUser();
        
            // Associer l'utilisateur au score
            $score->setUser($user);
        
        // Enregistrer l'entité dans la base de données
        $entityManager->persist($score);
        $entityManager->flush();

        $url = $this->generateUrl('app_scores');
        $response = new RedirectResponse($url);
        return $response;
    }



        return $this->render('home/index.html.twig', [
            'questions' => $questionsRepository->findAll(),
            'idquestions' => $questionsRepository->findBy(array(), array('id' => 'desc')),
            'totalEFC' => $totalEFC,
            'totalEIT' => $totalEIT,
            'totalEC' => $totalEC,
        ]);
    }

    #[Route('/scores', name: 'app_scores')]
    public function scores(ScoreRepository $scoreRepository): Response
    {
        // Récupérer tous les scores enregistrés
        $scores = $scoreRepository->findAll();
        
        // Passer les scores à la vue pour les afficher
        return $this->render('question/scores.html.twig', [
            'scores' => $scores,
        ]);
    }
   
}
<?php

namespace App\Controller;

use App\Entity\ExamResult;
use App\Form\ExamResultType;
use App\Repository\ExamResultRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExamResultController extends AbstractController
{
    #[Route('/examresults', name: 'examresult_index')]
    public function index(ExamResultRepository $examResultRepository): Response
    {
        $examResults = $examResultRepository->findAll();

        return $this->render('examresult/index.html.twig', [
            'examResults' => $examResults,
        ]);
    }

    #[Route('/examresults/create', name: 'examresult_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $examResult = new ExamResult();
        $form = $this->createForm(ExamResultType::class, $examResult);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($examResult);
            $em->flush();

            return $this->redirectToRoute('examresult_index');
        }

        return $this->render('examresult/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/examresults/edit/{id}', name: 'examresult_edit')]
    public function edit(ExamResult $examResult, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ExamResultType::class, $examResult);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('examresult_index');
        }

        return $this->render('examresult/edit.html.twig', [
            'form' => $form->createView(),
            'examResult' => $examResult,
        ]);
    }

    #[Route('/examresults/delete/{id}', name: 'examresult_delete')]
    public function delete(ExamResult $examResult, EntityManagerInterface $em): Response
    {
        $em->remove($examResult);
        $em->flush();

        return $this->redirectToRoute('examresult_index');
    }
}

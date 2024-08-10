<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectController extends AbstractController
{
    #[Route('/subjects', name: 'subject_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $subjects = $em->getRepository(Subject::class)->findAll();

        return $this->render('subject/index.html.twig', [
            'subjects' => $subjects,
        ]);
    }

    #[Route('/subjects/create', name: 'subject_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($subject);
            $em->flush();

            return $this->redirectToRoute('subject_index');
        }

        return $this->render('subject/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/subjects/edit/{id}', name: 'subject_edit')]
    public function edit(Subject $subject, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SubjectType::class, $subject);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('subject_index');
        }

        return $this->render('subject/edit.html.twig', [
            'form' => $form->createView(),
            'subject' => $subject,
        ]);
    }

    #[Route('/subjects/delete/{id}', name: 'subject_delete')]
    public function delete(Subject $subject, EntityManagerInterface $em): Response
    {
        $em->remove($subject);
        $em->flush();

        return $this->redirectToRoute('subject_index');
    }
}

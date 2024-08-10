<?php

namespace App\Controller;

use App\Entity\Pupil;
use App\Form\PupilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PupilController extends AbstractController
{
    #[Route('/pupils', name: 'pupil_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $pupils = $em->getRepository(Pupil::class)->findAll();

        return $this->render('pupil/index.html.twig', [
            'pupils' => $pupils,
        ]);
    }

    #[Route('/pupils/create', name: 'pupil_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $pupil = new Pupil();
        $form = $this->createForm(PupilType::class, $pupil);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($pupil);
            $em->flush();

            return $this->redirectToRoute('pupil_index');
        }

        return $this->render('pupil/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pupils/edit/{id}', name: 'pupil_edit')]
    public function edit(Pupil $pupil, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PupilType::class, $pupil);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('pupil_index');
        }

        return $this->render('pupil/edit.html.twig', [
            'form' => $form->createView(),
            'pupil' => $pupil,
        ]);
    }

    #[Route('/pupils/delete/{id}', name: 'pupil_delete')]
    public function delete(Pupil $pupil, EntityManagerInterface $em): Response
    {
        $em->remove($pupil);
        $em->flush();

        return $this->redirectToRoute('pupil_index');
    }
}

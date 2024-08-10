<?php

namespace App\Controller;

use App\Entity\Homepage;
use App\Form\HomepageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $em): Response
    {
        $homepages = $em->getRepository(Homepage::class)->findAll();

        return $this->render('homepage/index.html.twig', [
            'homepages' => $homepages,
        ]);
    }

    #[Route('/homepage/create', name: 'homepage_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $homepage = new Homepage();
        $form = $this->createForm(HomepageType::class, $homepage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($homepage);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('homepage/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/homepage/edit/{id}', name: 'homepage_edit')]
    public function edit(Homepage $homepage, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(HomepageType::class, $homepage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('homepage/edit.html.twig', [
            'form' => $form->createView(),
            'homepage' => $homepage,
        ]);
    }
}

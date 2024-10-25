<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showauthor/{value}', name: "author_show")]
    public function showAuthor($value): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $value
        ]);
    }

    #[Route('/coach', name: 'add_coach')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coach = new Coach();
        $form = $this->createForm(CoachType::class, $coach);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coach);
            $entityManager->flush();

            return $this->redirectToRoute('list_coach'); // Redirige vers la liste des coachs par exemple
        }

        return $this->render('coach/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

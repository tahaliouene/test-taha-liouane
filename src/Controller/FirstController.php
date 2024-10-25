<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/first')]
class FirstController extends AbstractController
{

    
    #[Route('/', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'classe' => '3A8',
        ]);
    }

    #[Route('/show/{name}', name: "first_show")]
    public function show($name): Response
    {
        return $this->render('first/show.html.twig', [
            'n' => $name
        ]);
    }
    #[Route('/redirect', name: "first_redirect")]
    public function redirectIndex(): Response
    {
        return $this->redirectToRoute('app_first');
    }
}

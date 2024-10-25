<?php

namespace App\Controller;

use App\Entity\Coach;
use App\Form\CoachType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;


class CoachController extends AbstractController
{
    #[Route('/coach', name: 'add_coach')] 
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coach = new Coach();
        $form = $this->createForm(CoachType::class, $coach);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coach);
            $entityManager->flush();

             // Redirige vers la liste des coachs
        }
        else
        {if ($form->isSubmitted() && $form->isValid()==0)
           {$form->addError(new FormError('Un coach avec ce CIN existe déjà.'));}
        
           
        }

        return $this->render('coach/add.html.twig', [ 'form' => $form->createView(),]);
    }

    #[Route('/coachdelete/{id}', name: 'delete_coach')] 
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $coach = $entityManager->getRepository(Coach::class)->find($id);

        if ($coach) {
            $entityManager->remove($coach);
            $entityManager->flush();
        }
        $coaches = $entityManager->getRepository(Coach::class)->findAll();

        return $this->render('coach/list.html.twig', [
            'coaches' => $coaches,
        ]);
         // Redirige vers la liste des coachs
    }

    #[Route('/coachlist', name: 'list_coach')] // Route pour lister les coachs
    public function list(EntityManagerInterface $entityManager): Response
    {
        $coaches = $entityManager->getRepository(Coach::class)->findAll();

        return $this->render('coach/list.html.twig', [
            'coaches' => $coaches,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use App\Entity\Eleve;
use App\Form\EleveType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Classe;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

final class EleveController extends AbstractController
{
    #[Route('/eleve', name: 'app_eleve', methods: ['GET'])]
    public function index(EleveRepository $eleveRepository): Response
    {
        $eleves = $eleveRepository->findAll();
        return $this->render('eleve/index.html.twig', [
            'controller_name' => 'EleveController',
            'eleves' => $eleves

        ]);
    }

    #[Route('/eleve/ajouter', name: 'app_eleve_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $eleve = new Eleve();
        
        // Utilisation de la classe Form
        $form = $this->createForm(EleveType::class, $eleve);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($eleve);
            $em->flush();

            $this->addFlash('success', 'Élève ajouté avec succès');

            return $this->redirectToRoute('app_eleve_ajouter');
        }

        return $this->render('eleve/ajouter.html.twig', [
            'form' => $form,
        ]);
    }
}
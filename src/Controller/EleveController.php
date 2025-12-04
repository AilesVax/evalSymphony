<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EleveRepository;


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

}
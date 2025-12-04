<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe', methods: ['GET'])]
    public function index(ClasseRepository $classeRepository): Response
    {
        $classes = $classeRepository->findAll();

        return $this->render('classe/index.html.twig', [
            'classes' => $classes
        ]);
    }
}

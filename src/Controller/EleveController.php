<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Classe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

final class EleveController extends AbstractController
{
    #[Route('/eleve', name: 'app_eleve')]
    public function index(): Response
    {
        return $this->render('eleve/index.html.twig', [
            'controller_name' => 'EleveController',
        ]);
    }

    #[Route('/eleve/ajouter', name: 'app_eleve_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $eleve = new Eleve();

        $form = $this->createFormBuilder($eleve)
            ->add('prenom', TextType::class, ['label' => 'Prénom'])
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('class', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'nom',
                'label' => 'Classe',
                'placeholder' => 'choisir une classe',
            ])
            ->add('ajouter', SubmitType::class, ['label' => 'ajouter'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($eleve);
            $em->flush();

            $this->addFlash('success', 'élève ajouté');

            return $this->redirectToRoute('app_eleve_ajouter');
        }

        return $this->render('eleve/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

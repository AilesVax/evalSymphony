<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class)
            ->add('nom', TextType::class)
            ->add('class', EntityType::class, [
                    'class' => Classe::class,
                    'choice_label' => 'nom_classe',
                    'label' => 'Classe',
                    'placeholder' => 'Choisir une classe'
])
            ->add('Ajouter', SubmitType::class)
        ;
    }

}

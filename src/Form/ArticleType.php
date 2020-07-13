<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'label' => "Date d'arrivée",
                'widget' => 'single_text'
            ])
            ->add('ville', TextType::class, [
                'label' => "Ville du séjour"
            ])
            ->add('departement', TextType::class, [
                'label' => "Département (En lettres)"
            ])
            ->add('titre', TextType::class, [
                'label' => "Titre de l'article"
            ])
            ->add('contenu', TextareaType::class, [
                'label' => "Contenu de l'article",
                'attr' => [
                    'rows' => '20'
                ]
            ])
            ->add('intro', TextType::class, [
                'label' => "Introduction (pour la page de présentation)"
            ])
            ->add('noteCamping', NumberType::class, [
                'label' => "Note séjour"
            ])
            ->add('images', FileType::class, [
                'label' => "Ajouter des photos ",
                'multiple' => true,
                'mapped' => false,
                'required' => false,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

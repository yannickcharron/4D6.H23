<?php

namespace App\Form;

use App\Entity\Computer;
use App\Entity\ComputerCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComputerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('buildName',TextType::class, 
                ['label' => 'Nom du système'])
            ->add('category', EntityType::class, 
                [ 'class' => ComputerCategory::class,
                  'choice_label' => 'categoryName',
                  'label' => 'Catégorie'
                ])
            ->add('motherboard', TextType::class, 
                ['label' => 'Carte mère'])
            ->add('cpu', TextType::class, 
                ['label' => 'Processeur'])
            ->add('memory', NumberType::class,
                ['label' => 'Mémoire vive',
                 'html5' => true,
                 'help'=> 'Indiquer le nombre de Go de mémoire'])
            ->add('storage', TextType::class, 
                ['label' => 'Espace disque'])
            ->add('gpu', ChoiceType::class, 
                ['label' => 'Carte graphique',
                 'required' => false,
                 'choices' => [
                    'Nvidia GeForce RTX4090' => 'RTX4090',
                    'AMD Radeon 7900XTX' => '7900XTX',
                    'Quadro 4000' => 'QUA4000'
                 ]])
            ->add('notes', TextareaType::class, 
                  ['label' => 'Notes',
                     'required' => false
                  ])
            ->add('isAssembleByUs', CheckboxType::class, [
                   'label' => 'Assemblé chez nous?',
                   'required' => false])
            ->add('save', SubmitType::class, ['label' => 'Sauvegarder']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Computer::class,
        ]);
    }
}

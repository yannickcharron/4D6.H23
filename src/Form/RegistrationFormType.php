<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'label' => 'Nom d\'utilisateur',
                'attr' => []])
            ->add('lastName', TextType::class, [
                'required' => true, 
                'label' => 'Nom', 
                'attr' => []])
            ->add('firstName', TextType::class, [
                'required' => true, 
                'label' => 'Prénom', 
                'attr' => []])
            ->add('email', EmailType::class, [ 
                'required' => true,
                'label' => 'Courriel',
                'attr' => []])
            ->add('betaKey', TextType::class, [
                'required' => true,
                'label' => 'Clé d\'accès', 
                'attr' => []])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => 'Téléphone',
                'attr' => []])
            ->add('password', RepeatedType::class, [
               'type' => PasswordType::class,
               'invalid_message' => "Les mots de passe doivent être identiques",
               'constraints' => [new Assert\Length(min:6, minMessage:"Le mot de passe doit contenir au moins {{ limit }} caractères")],
               'options' => ['attr' => ['class' => 'password-field']],
               'required' => true,
               'first_options' => ['label' => "Mot de passe"], 
               'second_options' => ['label' => "Confirmation du mot de passe"]])
            ->add('create', SubmitType::class, [
                'label' => "Créer votre compte",
                'row_attr' => ['class' => 'form-button'],
                'attr' => ['class' => 'btnCreate btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

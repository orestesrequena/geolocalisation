<?php 

// src/Form/TaskType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('dateNaissance', DateType::class, array(
                'widget' => 'single_text',
            
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,
                'format' => 'dd-MM-yyyy',
                'label' => 'Date Naissance dd-MM-yyyy',
            
            ))
            ->add('email', EmailType::class)
            ->add('sexe', ChoiceType::class, [
                'choices'   => [
                    'Homme' =>"Homme",
                    'Femme'  =>"Femme"
                ]
                ])
            ->add('pays', TextType::class)
            ->add('region' ,TextType::class)
            ->add('metier', ChoiceType::class, [
                'choices'   => [
                    'Client'                  => 'Client',
                    'ClientAdministrateur'    => 'ClientAdministrateur',
                    'Comptable'               =>    'Comptable',
                    'Technicien'              =>    'Technicien',
                    
                ]
                ])
          
            ->add('save', SubmitType::class)
        ;
    }
}
<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nom',                    TextType::class)
          ->add('prenom',                 TextType::class)
          ->add('sexe',                   TextType::class)
          ->add('pays',                   TextType::class)
        //   ->add('email',                  EmailType::class)
        //   ->add('username',              TextType::class,[
        //          'error_bubbling'              => true
        //        ])
        //   ->add('telephone',              TextType::class)
        //   ->add('telephonePortable',      TextType::class)
        //   ->add('roles',                  ChoiceType::class, [
        //     'choices'   => [
        //         'Client'                  => 'ROLE_CLIENT',
        //         'ClientAdministrateur'    => 'ROLE_CLIENT_ADMIN',
        //         'Comptable'               => 'ROLE_COMPTABLE',
        //         'Technicien'              => 'ROLE_SUPER_TECH',
        //         'SuperAdministrateur'     => 'ROLE_SUPER_ADMIN',
        //     ],
        //     "required"                    => true,
        //     'placeholder'                 => 'Choisir un rôle',
        //     "data"                        => $options["data"]->getRoles()[0]
        //   ])
        //   ->add('client',                 EntityType::class, [
        //       'class'                     => 'DISIntranetClientBundle:Client',
        //       'choice_label'              => 'nom',
        //       "required"                  => true,
        //     ])
        //   ->add('clientNom',              TextType::class,[
        //          "mapped"                 =>false,
        //          "required"               => false
        //        ])
        //   ->add('password',               RepeatedType::class,[
        //       'type'                      => PasswordType::class,
        //       'invalid_message'           => 'Les mots de passes ne correspondent pas.',
        //       'options'                   => array('attr' => array('class' => 'password-field')),
        //       'required'                  => false,
        //       'first_options'             => array('label' => 'Nouveau Mot de passe'),
        //       'second_options'            => array('label' => 'Confirmation du Mot de passe'),
        //   ])

          ->add('enregistrer',            SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user';
    }


}

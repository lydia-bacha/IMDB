<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null)
           // ->add('roles', null )
            ->add('password',null)
            ->add('nom', null)
            ->add('prenom', null)
        ;

        if($options["isAdmin"] == true ){
            $builder->add('roles', ChoiceType::class,[
            "choices"=>[
                "Rôle administrateur"=>"ROLE_ADMIN",
                //"Rôle utilisateur"=>"ROLE_USER"
            ],
              
                "multiple"=>true,
                "expanded"=>true
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'isAdmin'=>false
        ]);
    }
}

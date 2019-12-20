<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('email')
//            ->add('password')
            ->add('lastname', null, [
                'label' => 'Nom'
            ])
            ->add('firstname', null, [
                'label' => 'Prenom'
            ])
            ->add('age', null, [
                'label' => 'Age',

            ])
            ->add('taille', null, [
                'label' => 'Taille(cm)'
            ])
            ->add('weight', null, [
                'label' => 'Poid(kg)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

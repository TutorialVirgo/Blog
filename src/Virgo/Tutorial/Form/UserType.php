<?php

namespace Virgo\Tutorial\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;
use Virgo\Tutorial\Entity\User;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', [
                'invalid_message' => 'Invalid name.'
            ])
            ->add('password', 'repeated', [
                'type' => 'password',
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'invalid_message' => 'The password fields must match.'
            ])
            ->add('email', 'email', [
                'invalid_message' => 'Invalid email.',
                'constraints' => [
                    new Constraints\Length(['min' => 6, 'max' => 255]),
                    new Constraints\Email(['checkMX' => true])
                ]
            ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}

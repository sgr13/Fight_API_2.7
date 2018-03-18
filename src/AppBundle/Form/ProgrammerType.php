<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 18.03.18
 * Time: 00:49
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgrammerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname', 'text')
            ->add('avatarNumber', 'choice', array(
               'choices' => array(
                   1 => 'Girl(green)',
                   2 => 'Boy',
                   3 => 'Cat',
                   4 => 'Boy with Hat',
                   5 => 'Happy Robot',
                   6 => 'Girl (purple)'
               )
            ))
            ->add('tagLine', 'textarea');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Programmer'
        ));
    }

    public function getName()
    {
        
    }
}
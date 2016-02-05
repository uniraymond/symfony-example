<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @package AppBundle\Form
 * @author Raymond F. <raymond@studionone.com.au>
 * Date: 5/02/2016
 * Time: 11:35 AM
 */
class taskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    'Pending' => 0,
                    'Finish'  => 1
                ),
                'choices_as_values' => true))
            ->add('user', 'entity', array(
                'class' => 'AppBundle\Entity\User',
                'choice_label' => 'Fname',
                'empty_value' => 'Select ...'
            ))
            ->add('tag')
            ->add('content')
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr'  =>  array('class' => 'btn btn-primary pull-right')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task'
        ));
    }
}
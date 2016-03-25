<?php

namespace PlanmealBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class RepasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                ))
            ->add('moment', ChoiceType::class, array(
                'choices' => array('Matin' => 'Matin', 'Midi' => 'Midi', 'Soir' => 'Soir'),
                'expanded' => false,
                'multiple' => false
                ))
            ->add('commentaire', TextareaType::class, array(
                'required' => false,
                'empty_data'  => null
                ))
            ->add('plats', EntityType::class, array(
                'class' => 'PlanmealBundle:Plat',
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'query_builder' => function (EntityRepository $er)
                {
                    return $er->createQueryBuilder('p')->orderBy('p.nom', 'ASC');
                }
                ))
            ->add('save', SubmitType::class, array('label' => 'Valider le repas'))
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'PlanmealBundle\Entity\Repas'
		));
	}

}


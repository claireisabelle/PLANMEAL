<?php

namespace PlanmealBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('categorie', ChoiceType::class, array(
                'choices' => array('Entrée' => 'Entrée', 'Principal' => 'Principal', 'Dessert' => 'Dessert', 'Autre' => 'Autre'),
                'expanded' => true,
                'multiple' => false
                ))
            ->add('type', EntityType::class, array(
                'class' => 'PlanmealBundle:Type',
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'query_builder' => function (EntityRepository $er)
                {
                    return $er->createQueryBuilder('t')->orderBy('t.nom', 'ASC');
                }
                ))
            ->add('save', SubmitType::class, array('label' => 'Valider le plat'))
        ;
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'PlanmealBundle\Entity\Plat'
		));
	}

}


<?php

namespace PlanmealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PlanmealBundle\Entity\Type;

use PlanmealBundle\Form\Type\TypeType;

class ParametresController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listeTypes = $em->getRepository('PlanmealBundle:Type')->findBy(array(), array('nom' => 'ASC'));

        return $this->render('PlanmealBundle:parametres:index.html.twig', array('listeTypes' => $listeTypes));
    }

    
   	public function typeAjouterAction(Request $request)
    {
    	$type = new Type();

    	$form = $this->createForm(TypeType::class, $type);
    	$form->handleRequest($request);
    	
    	if($form->isSubmitted() && $form->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($type);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success', 'Le type de plat a bien été ajouté.');

    		return $this->redirectToRoute('planmeal_parametres_index');
    	}
    	

    	return $this->render('PlanmealBundle:parametres:type-ajouter.html.twig', array('form' => $form->createView()));
    }

    public function typeEditerAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$type = $em->getRepository('PlanmealBundle:Type')->find($id);

    	if(!$type)
    	{
    		throw $this->createNotFoundException('Le type de plat n° '.$id.' est inconnu.');
    	}

    	$form = $this->createForm(TypeType::class, $type);
    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid())
    	{
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success', 'Le type de plat a bien été édité.');

    		return $this->redirectToRoute('planmeal_parametres_index');
    	}

    	return $this->render('PlanmealBundle:parametres:type-editer.html.twig', array('form' => $form->createView()));

    }


    public function typeSupprimerAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$type = $em->getRepository('PlanmealBundle:Type')->find($id);

    	if(!$type)
    	{
    		throw $this->createNotFoundException('Le type de plat n° '.$id.' est inconnu.');
    	}

    	$form = $this->createFormBuilder()->getForm();

		if($form->handleRequest($request)->isValid())
		{
			$em->remove($type);
			$em->flush();

			$request->getSession()->getFlashBag()->add('success', 'Le type de plat a bien été supprimé.');

			return $this->redirectToRoute('planmeal_parametres_index');
		}

		return $this->render('PlanmealBundle:parametres:type-supprimer.html.twig', array('type' => $type, 'form' => $form->createView()));

    }

}

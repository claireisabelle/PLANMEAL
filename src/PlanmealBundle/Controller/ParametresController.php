<?php

namespace PlanmealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PlanmealBundle\Entity\Type;

class ParametresController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listeTypes = $em->getRepository('PlanmealBundle:Type')->findBy(array(), array('nom' => 'ASC'));

        return $this->render('PlanmealBundle:parametres:index.html.twig', array('listeTypes' => $listeTypes));
    }

    
   	public function typeAjouterAction()
    {
    	$type = new Type();

    	// $form = $this->createForm(TypeType::class, $type);
    	// $form->handleRequest($request);
    	/*
    	if($form->isSubmitted && $form->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($type);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success', 'Le type de plat a bien été ajouté.');

    		return $this->render('PlanmealBundle:parametres:index.html.twig');
    	}
    	*/

    	return $this->render('PlanmealBundle:parametres:type-ajouter.html.twig');
    }

    public function typeEditerAction(Request $request, $id)
    {

    }

    public function typeSupprimerAction(Request $request, $id)
    {

    }

}

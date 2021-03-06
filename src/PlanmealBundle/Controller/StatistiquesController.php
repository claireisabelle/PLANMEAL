<?php

namespace PlanmealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistiquesController extends Controller
{

	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$listePlats = $em->getRepository('PlanmealBundle:Plat')->getPlats();

		return $this->render('PlanmealBundle:statistiques:index.html.twig', array('listePlats' => $listePlats));
	}


}


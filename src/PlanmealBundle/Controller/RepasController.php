<?php

namespace PlanmealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class RepasController extends Controller
{
    public function indexAction($annee, $semaine)
    {
        $annee = date('Y');
        $semaine = date('W');

        // Récupération de la date du premier jour de la semaine (lundi) par rapport à l'année et la semaine
        $lundi = new \DateTime();
		$lundi ->setISOdate($annee, $semaine);
  

        if($semaine < 1 || $semaine > 53)
        {
        	throw $this->createNotFoundException('Cette semaine ne peut exister sur Terre.');
        }

        return $this->render('PlanmealBundle:repas:calendrier.html.twig', array('annee' => $annee,'semaine' => $semaine, 'lundi' => $lundi));
    }


    public function semaineSuivanteAction($annee, $semaine)
    {


		if($semaine < 1 || $semaine > 53)
		{
			throw $this->createNotFoundException('Cette semaine ne peut exister sur Terre.');
		}

		// Récupération de la date du premier jour de la semaine (lundi) par rapport à l'année et la semaine
        $lundi = new \DateTime();
		$lundi ->setISOdate($annee, $semaine);

        return $this->render('PlanmealBundle:repas:calendrier.html.twig', array('annee' => $annee, 'semaine' => $semaine, 'lundi' => $lundi));
    }

}


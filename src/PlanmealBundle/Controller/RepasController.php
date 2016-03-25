<?php

namespace PlanmealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

use PlanmealBundle\Entity\Repas;
use PlanmealBundle\Form\Type\RepasType;

class RepasController extends Controller
{
    public function indexAction()
    {
    	$annee = date('Y');
        $semaine = date('W');

        return $this->redirectToRoute('planmeal_semaine_suivante', array('annee' => $annee, 'semaine' => $semaine));
    }


    public function semaineSuivanteAction($annee, $semaine)
    {

		if($semaine < 1 || $semaine > 53)
		{
			throw $this->createNotFoundException('Cette semaine ne peut exister sur Terre.');
		}

		// Récupération de la date du premier jour de la semaine (lundi) par rapport à l'année et la semaine
        $lundi = new \DateTime();
		$lundi->setISOdate($annee, $semaine);

        return $this->render('PlanmealBundle:repas:calendrier.html.twig', array('annee' => $annee, 'semaine' => $semaine, 'lundi' => $lundi));
    }


    public function planifierAction()
    {
    	$em = $this->getDoctrine()->getManager();

    	$listeRepas = $em->getRepository('PlanmealBundle:Repas')->findBy(array(), array('date' => 'DESC'));

    	return $this->render('PlanmealBundle:repas:repas-planifier.html.twig', array('listeRepas' => $listeRepas));
    }


    public function ajouterAction(Request $request)
    {
    	$repas = new Repas();

    	$form = $this->createForm(RepasType::class, $repas);
    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($repas);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success', 'Le repas a bien été enregistré.');

    		return $this->redirectToRoute('planmeal_repas_planifier');
    	}

    	return $this->render('PlanmealBundle:repas:repas-ajouter.html.twig', array('form' => $form->createView()));
    }


    public function editerAction()
    {

    }


    public function supprimerAction()
    {

    }


}


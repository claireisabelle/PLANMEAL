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

		$em = $this->getDoctrine()->getManager();

		$listeRepas = $em->getRepository('PlanmealBundle:Repas')->findRepas($annee, $semaine);

        return $this->render('PlanmealBundle:repas:calendrier.html.twig', 
        			array('annee' => $annee, 'semaine' => $semaine, 'lundi' => $lundi, 'listeRepas' => $listeRepas));
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


    public function editerAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$repas = $em->getRepository('PlanmealBundle:Repas')->find($id);

    	if(!$repas)
    	{
    		throw $this->createNotFoundException('Le repas n° '.$id.' est inconnu.');
    	}

    	$form = $this->createForm(RepasType::class, $repas);
    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid())
    	{
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success', 'Le repas a bien été mis à jour.');

    		return $this->redirectToRoute('planmeal_repas_planifier');
    	}

    	return $this->render('PlanmealBundle:repas:repas-editer.html.twig', array('form' => $form->createView()));
    }


    public function supprimerAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$repas = $em->getRepository('PlanmealBundle:Repas')->find($id);

    	if(!$repas)
    	{
    		throw $this->createNotFoundException('Le repas n° '.$id.' est inconnu.');
    	}

    	$form = $this->createFormBuilder()->getForm();

    	if($form->handleRequest($request)->isValid())
    	{
    		$em->remove($repas);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success', 'Le repas a bien été supprimé.');

    		return $this->redirectToRoute('planmeal_repas_planifier');
    	}

    	return $this->render('PlanmealBundle:repas:repas-supprimer.html.twig', array('repas' => $repas, 'form' => $form->createView()));

    }


}


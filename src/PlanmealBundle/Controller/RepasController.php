<?php

namespace PlanmealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RepasController extends Controller
{
    public function indexAction()
    {
        return $this->render('PlanmealBundle:repas:calendrier.html.twig');
    }
}

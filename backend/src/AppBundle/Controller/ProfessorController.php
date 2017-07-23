<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProfessorController extends Controller
{
    /**
     * @Get("/professors")
     */
    public function getProfessorsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $professors = $em->getRepository('AppBundle:Professor')->findProfessors();

        $view = View::create()->setData(array('professors' => $professors));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}
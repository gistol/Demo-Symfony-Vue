<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CareerController extends Controller
{
    /**
     * @Get("/careers")
     */
    public function getCareersAction()
    {
        $em = $this->getDoctrine()->getManager();

        $careers = $em->getRepository('AppBundle:Career')->findCareers();

        $view = View::create()->setData(array('careers' => $careers));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}
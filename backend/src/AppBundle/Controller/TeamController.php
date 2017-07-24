<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Alumn;
use AppBundle\Entity\Professor;
use AppBundle\Entity\Robot;
use AppBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    /**
     * @Get("/teams")
     */
    public function getTeamsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('AppBundle:Team')->findTeams();

        $view = View::create()->setData(array('teams' => $teams));

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * @Post("/create/new/team")
     */
    public function postCreateTeamAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $result = null;

            $teamName = $request->request->get('team');
            $robotName = $request->request->get('robot');
            $professorId = $request->request->get('professor');
            $alumns = $request->request->get('alumns');

            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $team = new Team();
                $team->setName($teamName);

                if(!is_null($robotName)) {
                    // Create Robot
                    $robot = new Robot();
                    $robot->setName($robotName);
                    $em->persist($robot);
                    $em->flush();
                    $team->setRobot($robot);
                }

                // Get Asesor
                if (!is_null($professorId['name']) && !is_null($professorId['firstLastName']) && !is_null($professorId['email'])) {
                    $professor = new Professor();
                    $professor->setName($professorId['name']);
                    $professor->setFirstLastName($professorId['firstLastName']);
                    $professor->setSecondLastName($professorId['secondLastName']);
                    $professor->setEmail($professorId['email']);
                    $em->persist($professor);
                    $em->flush();
                    $team->setProfessor($professor);
                } else if ($professorId > 0) {
                    $professor = $em->getRepository('AppBundle:Professor')->findOneById($professorId);
                    $team->setProfessor($professor);
                }


                foreach ($alumns as $alumn) {
                    if (!is_null($alumn)) {
                        $a = new Alumn();
                        $a->setNoControl($alumn['noControl']);
                        $a->setName($alumn['name']);
                        $a->setFirstLastName($alumn['firstLastName']);
                        $a->setSecondLastName($alumn['secondLastName']);
                        $a->setEmail($alumn['email']);
                        $a->setSemester($alumn['semester']);
                        $a->setIsCaptain(false);
                        // Get Career
                        $career = $em->getRepository('AppBundle:Career')->findOneById($alumn['selectedCareer']);
                        // Set Career
                        $a->setCareer($career);
                        $em->persist($a);
                        $em->flush();
                        $team->addAlumn($a);
                    }
                }

                // Save Team
                $em->persist($team);
                $em->flush();
                $em->getConnection()->commit();
                $result = "OK-Registrado";
            } catch (Exception $e) {
                $em->getConnection()->rollBack();
                throw $e;
            }

            return new JsonResponse($result);
        }

        return new Response('This is not ajax!', 400);
    }
}

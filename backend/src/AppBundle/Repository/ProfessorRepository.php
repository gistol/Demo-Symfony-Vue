<?php

namespace AppBundle\Repository;

/**
 * ProfessorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProfessorRepository extends \Doctrine\ORM\EntityRepository
{
    public function findProfessors()
    {
        $em = $this->getEntityManager();
        $dql = $em->createQueryBuilder();
        $dql->select('p.id', 'p.name', 'p.firstLastName', 'p.secondLastName', 'p.email')
            ->from('AppBundle:Professor', 'p');

        return $dql->getQuery()->getResult();
    }
}

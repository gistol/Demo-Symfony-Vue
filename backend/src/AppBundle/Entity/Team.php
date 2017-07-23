<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Team
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="team_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /** @ORM\ManyToOne(targetEntity="AppBundle\Entity\Professor")
     *  @ORM\JoinColumn(name="professor", referencedColumnName="professor_id")
     */
    private $professor;

    /** @ORM\OneToOne(targetEntity="AppBundle\Entity\Robot")
     *  @ORM\JoinColumn(name="robot", referencedColumnName="robot_id")
     */
    private $robot;

    /**
     * Many Teams have Many Alumns.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Alumn")
     * @ORM\JoinTable(name="team_alumns",
     *     joinColumns={@ORM\JoinColumn(name="team", referencedColumnName="team_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="alumn", referencedColumnName="alumn_id", unique=true)}
     * )
     */
    private $alumns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumns = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set professor
     *
     * @param \AppBundle\Entity\Professor $professor
     *
     * @return Team
     */
    public function setProfessor(\AppBundle\Entity\Professor $professor = null)
    {
        $this->professor = $professor;

        return $this;
    }

    /**
     * Get professor
     *
     * @return \AppBundle\Entity\Professor
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Set robot
     *
     * @param \AppBundle\Entity\Robot $robot
     *
     * @return Team
     */
    public function setRobot(\AppBundle\Entity\Robot $robot = null)
    {
        $this->robot = $robot;

        return $this;
    }

    /**
     * Get robot
     *
     * @return \AppBundle\Entity\Robot
     */
    public function getRobot()
    {
        return $this->robot;
    }

    /**
     * Add alumn
     *
     * @param \AppBundle\Entity\Alumn $alumn
     *
     * @return Team
     */
    public function addAlumn(\AppBundle\Entity\Alumn $alumn)
    {
        $this->alumns[] = $alumn;

        return $this;
    }

    /**
     * Remove alumn
     *
     * @param \AppBundle\Entity\Alumn $alumn
     */
    public function removeAlumn(\AppBundle\Entity\Alumn $alumn)
    {
        $this->alumns->removeElement($alumn);
    }

    /**
     * Get alumns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumns()
    {
        return $this->alumns;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

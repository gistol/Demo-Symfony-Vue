<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumn
 *
 * @ORM\Table(name="alumns")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlumnRepository")
 */
class Alumn
{
    /**
     * @var int
     *
     * @ORM\Column(name="alumn_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="noControl", type="string", length=15, unique=true)
     */
    private $noControl;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstLastName", type="string", length=50)
     */
    private $firstLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="secondLastName", type="string", length=50, nullable=true)
     */
    private $secondLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="semester", type="integer")
     */
    private $semester;

    /** @ORM\ManyToOne(targetEntity="AppBundle\Entity\Career")
     *  @ORM\JoinColumn(name="career", referencedColumnName="career_id")
     */
    private $career;

    /**
     * @var bool
     *
     * @ORM\Column(name="isCaptain", type="boolean")
     */
    private $isCaptain;

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
     * Set noControl
     *
     * @param string $noControl
     *
     * @return Alumn
     */
    public function setNoControl($noControl)
    {
        $this->noControl = $noControl;

        return $this;
    }

    /**
     * Get noControl
     *
     * @return string
     */
    public function getNoControl()
    {
        return $this->noControl;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Alumn
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
     * Set firstLastName
     *
     * @param string $firstLastName
     *
     * @return Alumn
     */
    public function setFirstLastName($firstLastName)
    {
        $this->firstLastName = $firstLastName;

        return $this;
    }

    /**
     * Get firstLastName
     *
     * @return string
     */
    public function getFirstLastName()
    {
        return $this->firstLastName;
    }

    /**
     * Set secondLastName
     *
     * @param string $secondLastName
     *
     * @return Alumn
     */
    public function setSecondLastName($secondLastName)
    {
        $this->secondLastName = $secondLastName;

        return $this;
    }

    /**
     * Get secondLastName
     *
     * @return string
     */
    public function getSecondLastName()
    {
        return $this->secondLastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Alumn
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set semester
     *
     * @param integer $semester
     *
     * @return Alumn
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
     * @return integer
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Set isCaptain
     *
     * @param boolean $isCaptain
     *
     * @return Alumn
     */
    public function setIsCaptain($isCaptain)
    {
        $this->isCaptain = $isCaptain;

        return $this;
    }

    /**
     * Get isCaptain
     *
     * @return boolean
     */
    public function getIsCaptain()
    {
        return $this->isCaptain;
    }

    /**
     * Set career
     *
     * @param \AppBundle\Entity\Career $career
     *
     * @return Alumn
     */
    public function setCareer(\AppBundle\Entity\Career $career = null)
    {
        $this->career = $career;

        return $this;
    }

    /**
     * Get career
     *
     * @return \AppBundle\Entity\Career
     */
    public function getCareer()
    {
        return $this->career;
    }

    public function __toString()
    {
        return $this->getName() . ' ' . $this->getFirstLastName();
    }
}

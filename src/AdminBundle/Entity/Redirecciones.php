<?php

namespace AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Redirecciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     */
    private $desde;

    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     */
    private $para;

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
     * Set desde
     *
     * @param string $desde
     * @return Redirecciones
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;

        return $this;
    }

    /**
     * Get desde
     *
     * @return string 
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set para
     *
     * @param string $para
     * @return Redirecciones
     */
    public function setPara($para)
    {
        $this->para = $para;

        return $this;
    }

    /**
     * Get para
     *
     * @return string 
     */
    public function getPara()
    {
        return $this->para;
    }
}

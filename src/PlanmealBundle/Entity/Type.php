<?php

namespace PlanmealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="PlanmealBundle\Repository\TypeRepository")
 */
class Type
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreConsommation", type="integer")
     */
    private $nbreConsommation = 0;


    /**
    * @ORM\OneToMany(targetEntity="Plat", mappedBy="type")
    **/
    protected $plats;




    public function __construct()
    {
        $this->plats = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Type
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Add plat
     *
     * @param \PlanmealBundle\Entity\Plat $plat
     *
     * @return Type
     */
    public function addPlat(\PlanmealBundle\Entity\Plat $plat)
    {
        $this->plats[] = $plat;

        return $this;
    }

    /**
     * Remove plat
     *
     * @param \PlanmealBundle\Entity\Plat $plat
     */
    public function removePlat(\PlanmealBundle\Entity\Plat $plat)
    {
        $this->plats->removeElement($plat);
    }

    /**
     * Get plats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlats()
    {
        return $this->plats;
    }

    /**
     * Set nbreConsommation
     *
     * @param integer $nbreConsommation
     *
     * @return Type
     */
    public function setNbreConsommation($nbreConsommation)
    {
        $this->nbreConsommation = $nbreConsommation;

        return $this;
    }

    /**
     * Get nbreConsommation
     *
     * @return integer
     */
    public function getNbreConsommation()
    {
        return $this->nbreConsommation;
    }
}

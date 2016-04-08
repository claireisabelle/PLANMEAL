<?php

namespace PlanmealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity(repositoryClass="PlanmealBundle\Repository\PlatRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Plat
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
     * @ORM\Column(name="nbreUtilisation", type="integer")
     */
    private $nbreUtilisation = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUtilisation", type="datetime")
     */
    private $dateUtilisation;

    /**
    * @ORM\ManyToOne(targetEntity="Type", inversedBy="plats")
    */
    protected $type;

    /**
    * @ORM\ManyToMany(targetEntity="Repas", mappedBy="plats")
    **/
    protected $repas;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    public function __construct()
    {
        $this->repas = new ArrayCollection();
        $this->dateUtilisation = new \DateTime('2001-06-16');
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
     * @return Plat
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
     * Set nbreUtilisation
     *
     * @param integer $nbreUtilisation
     *
     * @return Plat
     */
    public function setNbreUtilisation($nbreUtilisation)
    {
        $this->nbreUtilisation = $nbreUtilisation;

        return $this;
    }

    /**
     * Get nbreUtilisation
     *
     * @return int
     */
    public function getNbreUtilisation()
    {
        return $this->nbreUtilisation;
    }

    /**
     * Set dateUtilisation
     *
     * @param \DateTime $dateUtilisation
     *
     * @return Plat
     */
    public function setDateUtilisation($dateUtilisation)
    {
        $this->dateUtilisation = $dateUtilisation;

        return $this;
    }

    /**
     * Get dateUtilisation
     *
     * @return \DateTime
     */
    public function getDateUtilisation()
    {
        return $this->dateUtilisation;
    }

    /**
     * Set type
     *
     * @param \PlanmealBundle\Entity\Type $type
     *
     * @return Plat
     */
    public function setType(\PlanmealBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \PlanmealBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add repa
     *
     * @param \PlanmealBundle\Entity\Repas $repa
     *
     * @return Plat
     */
    public function addRepa(\PlanmealBundle\Entity\Repas $repa)
    {
        $this->repas[] = $repa;

        return $this;
    }

    /**
     * Remove repa
     *
     * @param \PlanmealBundle\Entity\Repas $repa
     */
    public function removeRepa(\PlanmealBundle\Entity\Repas $repa)
    {
        $this->repas->removeElement($repa);
    }

    /**
     * Get repas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRepas()
    {
        return $this->repas;
    }

    public function increasePlat()
    {
        $this->nbreUtilisation++;
    }

    public function decreasePlat()
    {
        $this->nbreUtilisation--;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Plat
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}

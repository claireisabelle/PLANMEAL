<?php

namespace PlanmealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Repas
 *
 * @ORM\Table(name="repas")
 * @ORM\Entity(repositoryClass="PlanmealBundle\Repository\RepasRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Repas
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="moment", type="string", length=255)
     */
    private $moment;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="semaine", type="integer")
     */
    private $semaine;

    /**
     * @var int
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;


    /**
    * @ORM\ManyToMany(targetEntity="Plat", inversedBy="repas")
    **/
    protected $plats;


    public function __construct()
    {
        $this->plats = new ArrayCollection();
        $this->date = new \DateTime();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Repas
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set moment
     *
     * @param string $moment
     *
     * @return Repas
     */
    public function setMoment($moment)
    {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Get moment
     *
     * @return string
     */
    public function getMoment()
    {
        return $this->moment;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Repas
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set semaine
     *
     * @param integer $semaine
     *
     * @return Repas
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     */
    public function setSemaine()
    {
        
        $this->semaine = $this->getDate()->format('W');

        return $this;
    }

    /**
     * Get semaine
     *
     * @return int
     */
    public function getSemaine()
    {
        return $this->semaine;
    }

    /**
     * Add plat
     *
     * @param \PlanmealBundle\Entity\Plat $plat
     *
     * @return Repas
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
     * Set annee
     *
     * @param integer $annee
     *
     * @return Repas
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     */
    public function setAnnee()
    {
        
        $this->annee = $this->getDate()->format('Y');

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }
}

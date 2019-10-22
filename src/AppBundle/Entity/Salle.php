<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * salle
 *
 * @ORM\Table(name="salle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SalleRepository")
 */
class Salle
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
     * @var int
     *
     * @ORM\Column(name="nb_places", type="integer")
     */
    private $nbPlaces;

    /**
     * @var int
     *
     * @ORM\Column(name="num_salle", type="integer", unique=true)
     */
    private $numSalle;

    /**
     * @ManyToOne(targetEntity="Domaine")
     * @JoinColumn(name="fk_domaine_id", referencedColumnName="id")
     */

    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Promo", inversedBy="salles")
     */
    private $promo;

    public function __toString()
    {
        $format = "Nombre de places: %s, n°: %s, type: %s";
        return sprintf($format, $this->nbPlaces, $this->numSalle, $this->type);
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
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     *
     * @return salle
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Set numSalle
     *
     * @param integer $numSalle
     *
     * @return salle
     */
    public function setNumSalle($numSalle)
    {
        $this->numSalle = $numSalle;

        return $this;
    }

    /**
     * Get numSalle
     *
     * @return int
     */
    public function getNumSalle()
    {
        return $this->numSalle;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return salle
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param mixed $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }
}

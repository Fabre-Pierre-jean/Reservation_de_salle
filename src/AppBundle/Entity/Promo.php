<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * promo
 *
 * @ORM\Table(name="promo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromoRepository")
 */
class Promo
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
     * @ORM\Column(name="nb_eleve", type="integer")
     */
    private $nbEleves;

    /**
     * @var string
     *
     * @ORM\Column(name="course_title", type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="Formateur")
     */
    private $formateur;

    /**
     * @ORM\OneToMany(targetEntity="Salle", mappedBy="promo")
     */
    private $salles;

    public function __toString()
    {
        $format = "Nombre d'eleves: %s, Nom formation: %s";
        return sprintf($format, $this->nbEleves, $this->titre,$this->salles);
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
     * Set nbEleve
     *
     * @param integer $nbEleve
     *
     * @return promo
     */
    public function setNbEleves($nbEleves)
    {
        $this->nbEleves = $nbEleves;

        return $this;
    }

    /**
     * Get nbEleve
     *
     * @return int
     */
    public function getNbEleves()
    {
        return $this->nbEleves;
    }

    /**
     * Set courseTitle
     *
     * @param string $titre
     *
     * @return promo
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set formateur
     *
     * @param \AppBundle\Entity\Formateur $formateur
     *
     * @return Promo
     */
    public function setFormateur(\AppBundle\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \AppBundle\Entity\Formateur
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * Add salle
     *
     * @param \AppBundle\Entity\Salle $salle
     *
     * @return Promo
     */
    public function addSalle(\AppBundle\Entity\Salle $salle)
    {
        $this->salles[] = $salle;

        return $this;
    }

    /**
     * Remove salle
     *
     * @param \AppBundle\Entity\Salle $salle
     */
    public function removeSalle(\AppBundle\Entity\Salle $salle)
    {
        $this->salles->removeElement($salle);
    }

    /**
     * Get salles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSalles()
    {
        return $this->salles;
    }
}

<?php

namespace ElevationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spot
 *
 * @ORM\Table(name="spot")
 * @ORM\Entity(repositoryClass="ElevationBundle\Repository\SpotRepository")
 */
class Spot
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
     * @ORM\Column(name="longitude", type="decimal", scale=7)
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="latitude", type="decimal", scale=7)
     */
    private $latitude;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer", nullable=true)
     */
    private $iduser;


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
     * Set longitude
     *
     * @param integer $longitude
     * @return Spot
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return integer 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     * @return Spot
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return integer 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     * @return Spot
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}

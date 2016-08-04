<?php

namespace ElevationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Road
 *
 * @ORM\Table(name="road")
 * @ORM\Entity(repositoryClass="ElevationBundle\Repository\RoadRepository")
 */
class Road
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
     * @ORM\Column(name="round1", type="integer", nullable=true)
     */
    private $round1;

    /**
     * @var int
     *
     * @ORM\Column(name="round2", type="integer", nullable=true)
     */
    private $round2;

    /**
     * @var int
     *
     * @ORM\Column(name="round3", type="integer", nullable=true)
     */
    private $round3;

    /**
     * @var int
     *
     * @ORM\Column(name="round4", type="integer", nullable=true)
     */
    private $round4;

    /**
     * @var int
     *
     * @ORM\Column(name="round5", type="integer", nullable=true)
     */
    private $round5;

    /**
     * @var string
     *
     * @ORM\Column(name="seed", type="string", length=255, nullable=true)
     */
    private $seed;


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
     * Set round1
     *
     * @param integer $round1
     * @return Road
     */
    public function setRound1($round1)
    {
        $this->round1 = $round1;

        return $this;
    }

    /**
     * Get round1
     *
     * @return integer 
     */
    public function getRound1()
    {
        return $this->round1;
    }

    /**
     * Set round2
     *
     * @param integer $round2
     * @return Road
     */
    public function setRound2($round2)
    {
        $this->round2 = $round2;

        return $this;
    }

    /**
     * Get round2
     *
     * @return integer 
     */
    public function getRound2()
    {
        return $this->round2;
    }

    /**
     * Set round3
     *
     * @param integer $round3
     * @return Road
     */
    public function setRound3($round3)
    {
        $this->round3 = $round3;

        return $this;
    }

    /**
     * Get round3
     *
     * @return integer 
     */
    public function getRound3()
    {
        return $this->round3;
    }

    /**
     * Set round4
     *
     * @param integer $round4
     * @return Road
     */
    public function setRound4($round4)
    {
        $this->round4 = $round4;

        return $this;
    }

    /**
     * Get round4
     *
     * @return integer 
     */
    public function getRound4()
    {
        return $this->round4;
    }

    /**
     * Set round5
     *
     * @param integer $round5
     * @return Road
     */
    public function setRound5($round5)
    {
        $this->round5 = $round5;

        return $this;
    }

    /**
     * Get round5
     *
     * @return integer 
     */
    public function getRound5()
    {
        return $this->round5;
    }

    /**
     * Set seed
     *
     * @param string $seed
     * @return Road
     */
    public function setSeed($seed)
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * Get seed
     *
     * @return string 
     */
    public function getSeed()
    {
        return $this->seed;
    }
}

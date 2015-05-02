<?php

namespace XarismaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Station
 */
class Station
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $stationcode;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var \DateTime
     */
    private $dateupdated;

    /**
     * @var integer
     */
    private $deleted;


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
     * Set stationcode
     *
     * @param string $stationcode
     * @return Station
     */
    public function setStationcode($stationcode)
    {
        $this->stationcode = strtoupper($stationcode);

        return $this;
    }

    /**
     * Get stationcode
     *
     * @return string 
     */
    public function getStationcode()
    {
        return strtoupper($this->stationcode);
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Station
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Station
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return Station
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime 
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set dateupdated
     *
     * @param \DateTime $dateupdated
     * @return Station
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;

        return $this;
    }

    /**
     * Get dateupdated
     *
     * @return \DateTime 
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return Station
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}

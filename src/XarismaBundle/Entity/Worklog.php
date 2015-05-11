<?php

namespace XarismaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Worklog
 */
class Worklog
{
    /**
     * @var integer
     */
    private $id;

    private $station_id;
    private $order_id;
    private $user_id;
    
    /**
     * @var string
     */
    private $stationstatus;

    /**
     * @var string
     */
    private $comments;

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
     * @var \XarismaBundle\Entity\Station
     */
    private $station;

    /**
     * @var \XarismaBundle\Entity\Custorder
     */
    private $order;

    /**
     * @var \XarismaBundle\Entity\User
     */
    private $user;


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
     * Set stationstatus
     *
     * @param string $stationstatus
     * @return Worklog
     */
    public function setStationstatus($stationstatus)
    {
        $this->stationstatus = $stationstatus;

        return $this;
    }

    /**
     * Get stationstatus
     *
     * @return string 
     */
    public function getStationstatus()
    {
        return $this->stationstatus;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return Worklog
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return Worklog
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
     * @return Worklog
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
     * @return Worklog
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

    /**
     * Set station
     *
     * @param \XarismaBundle\Entity\Station $station
     * @return Worklog
     */
    public function setStation(\XarismaBundle\Entity\Station $station = null)
    {
        $this->station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return \XarismaBundle\Entity\Station 
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * Set order
     *
     * @param \XarismaBundle\Entity\Custorder $order
     * @return Worklog
     */
    public function setOrder(\XarismaBundle\Entity\Custorder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \XarismaBundle\Entity\Custorder 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set user
     *
     * @param \XarismaBundle\Entity\User $user
     * @return Worklog
     */
    public function setUser(\XarismaBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \XarismaBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set station_id
     *
     * @param integer $stationId
     * @return Worklog
     */
    public function setStationId($stationId)
    {
        $this->station_id = $stationId;

        return $this;
    }

    /**
     * Get station_id
     *
     * @return integer 
     */
    public function getStationId()
    {
        return $this->station_id;
    }

    /**
     * Set order_id
     *
     * @param integer $orderId
     * @return Worklog
     */
    public function setOrderId($orderId)
    {
        $this->order_id = $orderId;

        return $this;
    }

    /**
     * Get order_id
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return Worklog
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    /**
     * @var integer
     */
    private $stationId;

    /**
     * @var integer
     */
    private $orderId;

    /**
     * @var integer
     */
    private $userId;


}

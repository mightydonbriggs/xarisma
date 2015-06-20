<?php

namespace XarismaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fileops
 */
class Fileops
{
    public static $STATUS_IMPORTING = "IMPORTING";
    public static $STATUS_SUCCESS   = "SUCCESS";
    public static $STATUS_ERROR = "ERROR";
    public static $STATUS_EXPORTING = "EXPORTING";
    public static $STATUS_NORECS = "NO_RECS_TO_EXPORT";
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $action;

    /**
     * @var \DateTime
     */
    private $eventTime;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $md5;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $recs;

    /**
     * @var integer
     */
    private $errors;

    /**
     * @var integer
     */
    private $customerNew;

    /**
     * @var integer
     */
    private $customerUpdate;

    /**
     * @var integer
     */
    private $orderNew;

    /**
     * @var integer
     */
    private $orderUpdate;

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
     * Set action
     *
     * @param string $action
     * @return Fileops
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set eventTime
     *
     * @param \DateTime $eventTime
     * @return Fileops
     */
    public function setEventTime($eventTime)
    {
        $this->eventTime = $eventTime;

        return $this;
    }

    /**
     * Get eventTime
     *
     * @return \DateTime 
     */
    public function getEventTime()
    {
        return $this->eventTime;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Fileops
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set md5
     *
     * @param string $md5
     * @return Fileops
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;

        return $this;
    }

    /**
     * Get md5
     *
     * @return string 
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Fileops
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set recs
     *
     * @param integer $recs
     * @return Fileops
     */
    public function setRecs($recs)
    {
        $this->recs = $recs;

        return $this;
    }

    /**
     * Get recs
     *
     * @return integer 
     */
    public function getRecs()
    {
        return $this->recs;
    }

    /**
     * Set errors
     *
     * @param integer $errors
     * @return Fileops
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get errors
     *
     * @return integer 
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set customerNew
     *
     * @param integer $customerNew
     * @return Fileops
     */
    public function setCustomerNew($customerNew)
    {
        $this->customerNew = $customerNew;

        return $this;
    }

    /**
     * Get customerNew
     *
     * @return integer 
     */
    public function getCustomerNew()
    {
        return $this->customerNew;
    }

    /**
     * Set customerUpdate
     *
     * @param integer $customerUpdate
     * @return Fileops
     */
    public function setCustomerUpdate($customerUpdate)
    {
        $this->customerUpdate = $customerUpdate;

        return $this;
    }

    /**
     * Get customerUpdate
     *
     * @return integer 
     */
    public function getCustomerUpdate()
    {
        return $this->customerUpdate;
    }

    /**
     * Set orderNew
     *
     * @param integer $orderNew
     * @return Fileops
     */
    public function setOrderNew($orderNew)
    {
        $this->orderNew = $orderNew;

        return $this;
    }

    /**
     * Get orderNew
     *
     * @return integer 
     */
    public function getOrderNew()
    {
        return $this->orderNew;
    }

    /**
     * Set orderUpdate
     *
     * @param integer $orderUpdate
     * @return Fileops
     */
    public function setOrderUpdate($orderUpdate)
    {
        $this->orderUpdate = $orderUpdate;

        return $this;
    }

    /**
     * Get orderUpdate
     *
     * @return integer 
     */
    public function getOrderUpdate()
    {
        return $this->orderUpdate;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return Fileops
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
     * @return Fileops
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
     * @return Fileops
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

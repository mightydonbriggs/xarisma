<?php

namespace XarismaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Import
 */
class Import
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $importTime;

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
     * Set importTime
     *
     * @param \DateTime $importTime
     * @return Import
     */
    public function setImportTime($importTime)
    {
        $this->importTime = $importTime;

        return $this;
    }

    /**
     * Get importTime
     *
     * @return \DateTime 
     */
    public function getImportTime()
    {
        return $this->importTime;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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
     * @return Import
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

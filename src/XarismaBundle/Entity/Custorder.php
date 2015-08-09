<?php

namespace XarismaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Custorder
 */
class Custorder
{
    public static $STATUS_RECEIVED      = "RECEIVED";
    public static $STATUS_HOLD_CUST     = "HOLD_CUST";
    public static $STATUS_HOLD_MATERIAL = "HOLD_MATERIAL";
    public static $STATUS_HOLD_OTHER    = "HOLD_OTHER";
    public static $STATUS_PRODUCTION    = "PRODUCTION";
    public static $STATUS_SHIP_READY    = "SHIP_READY";
    public static $STATUS_SHIPPED       = "SHIPPED";
    
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var integer
     */
    private $customerId;

    /**
     * @var string
     */
    private $ordernumber;

    /**
     * @var string
     */
    private $orderstatus;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var integer
     */
    private $updateby;

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

    public function doPrePersist() {
        $this->setDatecreated();
    }
    
    public function doPreUpdate() {
        if(is_null($this->getDateexported()) || $this->getDateupdated() > $this->dateexported) {
            $this->setNeedsexport(true);
        }
    }
    
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
     * Set customerId
     *
     * @param integer $customerId
     * @return Custorder
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set ordernumber
     *
     * @param string $ordernumber
     * @return Custorder
     */
    public function setOrdernumber($ordernumber)
    {
        $this->ordernumber = $ordernumber;

        return $this;
    }

    /**
     * Get ordernumber
     *
     * @return string 
     */
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * Set orderstatus
     *
     * @param string $orderstatus
     * @return Custorder
     */
    public function setOrderstatus($orderstatus)
    {
        $this->orderstatus = $orderstatus;

        return $this;
    }

    /**
     * Get orderstatus
     *
     * @return string 
     */
    public function getOrderstatus()
    {
        return $this->orderstatus;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Custorder
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
     * Set updateby
     *
     * @param integer $updateby
     * @return Custorder
     */
    public function setUpdateby($updateby)
    {
        $this->updateby = $updateby;

        return $this;
    }

    /**
     * Get updateby
     *
     * @return integer 
     */
    public function getUpdateby()
    {
        return $this->updateby;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return Custorder
     */
    public function setDatecreated()
    {
//        $this->datecreated = $datecreated;
        $this->datecreated = new \DateTime();

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
     * @return Custorder
     */
    public function setDateupdated($dateupdated)
    {
//        $this->dateupdated = $dateupdated;
        $this->dateupdated = new \DateTime();
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
     * @return Custorder
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
     * @var \XarismaBundle\Entity\Customer
     */
    private $customer;


    /**
     * Set customer
     *
     * @param \XarismaBundle\Entity\Customer $customer
     * @return Custorder
     */
    public function setCustomer(\XarismaBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \XarismaBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
    /**
     * @var \DateTime
     */
    private $orderdate;


    /**
     * Set orderdate
     *
     * @param \DateTime $orderdate
     * @return Custorder
     */
    public function setOrderdate($orderdate)
    {
        $this->orderdate = $orderdate;

        return $this;
    }

    /**
     * Get orderdate
     *
     * @return \DateTime 
     */
    public function getOrderdate()
    {
        return $this->orderdate;
    }
    /**
     * @var integer
     */
    private $needsexport;

    /**
     * @var \DateTime
     */
    private $dateexported;


    /**
     * Set needsexport
     *
     * @param integer $needsexport
     * @return Custorder
     */
    public function setNeedsexport($needsexport)
    {
        $this->needsexport = $needsexport;

        return $this;
    }

    /**
     * Get needsexport
     *
     * @return integer 
     */
    public function getNeedsexport()
    {
        return $this->needsexport;
    }

    /**
     * Set dateexported
     *
     * @param \DateTime $dateexported
     * @return Custorder
     */
    public function setDateexported($dateexported)
    {
        $this->dateexported = $dateexported;

        return $this;
    }

    /**
     * Get dateexported
     *
     * @return \DateTime 
     */
    public function getDateexported()
    {
        return $this->dateexported;
    }
}

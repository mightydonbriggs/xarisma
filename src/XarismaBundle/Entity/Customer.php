<?php

namespace XarismaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 */
class Customer
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $customernumber;

    /**
     * @var string
     */
    private $accountname;

    /**
     * @var string
     */
    private $repname;

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
     * Set customernumber
     *
     * @param string $customernumber
     * @return Customer
     */
    public function setCustomernumber($customernumber)
    {
        $this->customernumber = $customernumber;

        return $this;
    }

    /**
     * Get customernumber
     *
     * @return string 
     */
    public function getCustomernumber()
    {
        return $this->customernumber;
    }

    /**
     * Set accountname
     *
     * @param string $accountname
     * @return Customer
     */
    public function setAccountname($accountname)
    {
        $this->accountname = $accountname;

        return $this;
    }

    /**
     * Get accountname
     *
     * @return string 
     */
    public function getAccountname()
    {
        return $this->accountname;
    }

    /**
     * Set repname
     *
     * @param string $repname
     * @return Customer
     */
    public function setRepname($repname)
    {
        $this->repname = $repname;

        return $this;
    }

    /**
     * Get repname
     *
     * @return string 
     */
    public function getRepname()
    {
        return $this->repname;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * Add orders
     *
     * @param \XarismaBundle\Entity\Custorder $orders
     * @return Customer
     */
    public function addOrder(\XarismaBundle\Entity\Custorder $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \XarismaBundle\Entity\Custorder $orders
     */
    public function removeOrder(\XarismaBundle\Entity\Custorder $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}

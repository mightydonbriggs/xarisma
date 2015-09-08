<?php

namespace XarismaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * User
 */
class User extends \FOS\UserBundle\Model\User
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
     protected $username;
    
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var integer
     */
    private $accesslevel;

    /**
     * @var string
     */
    protected $roles;

    /**
     * @var integer
     */
    private $updateby;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var \DateTimeset
     */
    private $dateupdated;

    /**
     * @var integer
     */
    private $deleted;


    public function __construct() {
        parent::__construct();
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = strtoupper($username);

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return strtoupper($this->username);
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set accesslevel
     *
     * @param integer $accesslevel
     * @return User
     */
    public function setAccesslevel($accesslevel)
    {
        $this->accesslevel = $accesslevel;

        return $this;
    }

    /**
     * Get accesslevel
     *
     * @return integer 
     */
    public function getAccesslevel()
    {
        return $this->accesslevel;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string 
     */
    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return $roles;
    }

    /**
     * Set updateby
     *
     * @param integer $updateby
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
     */
    public function setDeleted($deleted)
    {
        if(is_null($deleted)) {
            $deleted = false;
        }
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

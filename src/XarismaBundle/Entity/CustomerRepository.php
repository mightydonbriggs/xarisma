<?php
namespace XarismaBundle\Entity;

use XarismaBundle\Entity\BaseRepository;
use XarismaBundle\Entity\Customer;

/**
 * Repository for Customer Object.
 * 
 */
class CustomerRepository extends BaseRepository
{
    public function findByCustomerNum($customernumber) {        
        
        $result = $this->findOneBy(array('customernumber' => $customernumber, 'deleted' => 0));
   
        return $result;
    } 
        
}

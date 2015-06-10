<?php
namespace XarismaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Repository for Import Object.
 * 
 */
class ImportRepository extends EntityRepository
{
    public function md5IsUnique($md5) {
        $em = $this->getEntityManager();
        $result = $this->findBy(array('md5' => $md5));
        if(count($result) === 0) {
            return true; //md5 is unique
        } else {
            return false; //md5 is NOT unique
        }
    }
    
    
}

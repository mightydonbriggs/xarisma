<?php
namespace XarismaBundle\Entity;

use XarismaBundle\Entity\BaseRepository;
use XarismaBundle\Entity\Custorder;

/**
 * Repository for Custorder Object.
 * 
 */
class CustorderRepository extends BaseRepository
{
    public function findByCustomerNum($customernumber) {        
        
        $result = $this->findOneBy(array('customernumber' => $customernumber, 'deleted' => 0));
   
        return $result;
    }
    
    public function findLikeId($id) {
        
        $em = $this->getEntityManager();

        $id = (string) $id .'%';
//        $dql = 'SELECT co.id, co.ordernumber, co.orderdate, co.orderstatus, cu.accountname customername, co.needsexport '
//             . 'FROM XarismaBundle:Custorder co '
//             . 'LEFT JOIN co.customer cu'
//             . "WHERE co.id LIKE'" .$id ."%'";
        
        $query = $this->createQueryBuilder('co')
               ->select('co.ordernumber, cu.accountname customername, co.orderdate')
               ->join('co.customer', 'cu')
               ->where('co.ordernumber LIKE :srchid')
               ->setParameter('srchid', $id)
               ->getQuery();
        
        $result = $query->getArrayResult();

        return $result;
    }


    public function getArrayList($fieldlist = null, $deleted = false) {
        
        $em = $this->getEntityManager();
        
        $dql = 'SELECT co.id, co.ordernumber, co.orderdate, co.orderstatus, cu.accountname customername, co.needsexport '
             . 'FROM XarismaBundle:Custorder co '
             . 'LEFT JOIN co.customer cu';
        
        
        //--- Filter out deleted records, unless requested not to
        if($deleted !== false) {
            $dql .= 'WHERE deleted = 0';
        }
        
        try{
            $query = $em->createQuery($dql);
        } catch (QueryException $ex) {
        }
        
//        $result = new ArrayCollection($query->getArrayResult());
        $result = $query->getArrayResult();
//dump($result);
//die();

        return $result;
    }    
        
}

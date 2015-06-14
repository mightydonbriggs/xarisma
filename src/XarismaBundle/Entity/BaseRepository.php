<?php
namespace XarismaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\ORM\Query\QueryException;
use Doctrine\DBAL\Query\QueryException;

/**
 * Base Repository
 * 
 * This is the Base Repository. It defines functions that are available to all
 * other repositories. Entity Repositores should extend from this object, NOT
 * from Doctrine\ORM\EntityRepository.
 * 
 * @author Don Briggs <donbriggs@donbriggs.com>\
 * @since 11-Jun-2015
 * 
 */
class BaseRepository extends EntityRepository
{  
    
    /**
     * Get array list of objects
     * 
     * Use this function to provide the recordlist for the indexActions of the
     * controllers. This function will return the dataset as an array collection,
     * rather than a set of Doctrine objects. This hydration scheme is much
     * faster. Note that this function will inspect an entities metadata to
     * determine the entity name.
     *  
     * Unlike a regular array, you can iterate (ie, use a foreach loop) over an
     * ArrayCollection. You may optionally pass object fieldnames to be used in
     * the SELECT. If you do not provide a list of fieldnames, the query will
     * select all fields. By default, deleted records are not returned in the 
     * list. 
     * 
     * You can set the '$deleted' parameter to TRUE to include deleted records. 
     * 
     * Ifyou require a custom query for an indexAction, such as a query that
     * includes a join of object tables, you should extend this function.
     * 
     * @author Don Briggs <donbriggs@donbriggs.com>
     * @since 12-Jun-2015
     * @package DBO
     * 
     * @param text $fieldlist Comma-seperated list of fields to include in dataset
     * @param boolean $deleted Set to TRUE to include deleted records
     * @return ArrayCollection|false Iteratable array of records or false if error
     */
    public function getArrayList($fieldlist = null, $deleted = false) {
        
        $em = $this->getEntityManager();
        $srcName = $this->getClassMetadata()->rootEntityName;

        $dql = 'SELECT ';
        
        //--Build field list, if fields were passed to function
        if(is_null($fieldlist) || $fieldlist == '') {
            $dql .= 't '; //Add table alias to query
        } else {
            //Build field select list
            $fieldlist = explode(',', $fieldlist);
            foreach($fieldlist as $field) {
                $dql .= 't.' .trim($field) .', ';
            }
            $dql = substr($dql, 0, -2) .' ';
        }
        
        //--- Build FROM clause
        $dql .= 'FROM ' .$srcName .' t';
        
        //--- Filter out deleted records, unless requested not to
        if($deleted !== false) {
            $dql .= 'WHERE deleted = 0';
        }
        
        try{
            $query = $em->createQuery($dql);
        } catch (QueryException $ex) {
        }
        
        return new ArrayCollection($query->getArrayResult());
        
    } 

    
    
}

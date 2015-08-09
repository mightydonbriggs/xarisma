<?php
namespace XarismaBundle\Entity;

use XarismaBundle\Entity\BaseRepository;
use \Doctrine\DBAL\DriverManager;

/**
 * Repository for Import Object.
 * 
 */
class FileopsRepository extends BaseRepository
{
    /**
     * Determine if an md5 is unique
     * 
     * This function will determine if an md5 passed as a 
     * parameter, already exists in the import table, indicating
     * that this file has already been processed. It will
     * retun a True if the md5 is not already in the database,
     * and a False otherwise.
     * 
     * @param text $md5 md5 of the contents of the file to be imported
     * @return boolean True if md5 is not in import table, false otherwise.
     * 
     */
    public function md5IsUnique($md5) {
        $em = $this->getEntityManager();
        $result = $this->findBy(array('md5' => $md5));
        if(count($result) === 0) {
            return true; //md5 is unique
        } else {
            return false; //md5 is NOT unique
        }
    }
    
    
    /**
     * Read Import csv file
     * 
     * This function will read the data in a CSV file whos Fully-Qualified path is
     * passed as a parmeter. The data is returned as an import array.
     * 
     * @param text $filePath Fully qualified path to import file
     * @return array
     */
    public function readFile($filePath) {

        if(is_null(realpath($filePath))) {
            return array('status' => false,
                         'data' => 'ERROR: Could not find file:' .$filePath
                        );
        }
        
        if (($handle = fopen($filePath, "r")) === FALSE) {
            return array('status' => false,
                         'data' => 'ERROR: Could not open file:' .$filePath
                        );
        }
        
        $row = 0;
        $firstLine = true;
        $aryImport = array();
        
        while (($aryLine = fgetcsv($handle, 1000, ",")) !== FALSE) {
//dump($aryLine);
            if($firstLine) {
                //Skip first line, as it is the title line
                $firstLine = false;
                continue;
            }
            $aryImport[$row]['orderDate'] = trim($aryLine[0]);
            $aryImport[$row]['orderNum']  = trim($aryLine[1]);
            $customer                     = trim($aryLine[2]);
            $word = strpos($customer, ' ');
            $aryImport[$row]['customernumber']  = trim(substr($customer, 0, $word));
            $aryImport[$row]['accountname']  = trim(substr($customer, $word, strlen($customer)));
//            $aryImport[$row]['status']  = trim($aryLine[3]);
            $row++;
        }

        fclose($handle);
        return array('status' => true,
                     'data'   => $aryImport
                    );
    }

    
    
    public function getExportArray() {
         $em = $this->getEntityManager();
         
         $dql = 'SELECT co.ordernumber, co.orderstatus '
              . 'FROM XarismaBundle:Custorder co '
              . 'WHERE co.deleted = 0 AND co.needsexport != 0';
         
         if(!$query = $em->createQuery($dql)) {
             return array('status' => false,
                          'data'   => 'ERROR: Could not build export array');
         }
         $rows = $query->getArrayResult();

         $result = array('status' => true,
                         'data'   => $rows);
         return $result;
    }
    
    
    public function writeFile(array $aryExport, $filepath) {
        
        $exportDir = dirname($filepath);
        $numRecs = count($aryExport);
        $headerLine = "Number,Status" .PHP_EOL;
        $custUpdate = 0;
        $orderUpdate = 0;
        $custProcessed = array();
        $orderProcessed = array();
        
        if(realpath($exportDir) === null) {
            return array('status ' => false,
                         'data'    => 'ERROR: Could not find export dir: ' .$exportDir);
        } elseif (!is_writable($exportDir)) {
            return array('status ' => false,
                         'data'    => 'ERROR: Could not write to export dir: ' .$exportDir);
        } elseif ($numRecs === 0) {
            return array('status ' => false,
                         'data'    => 'ERROR: Export array contains no data');
        }
        
        $handle = fopen($filepath, 'w');
        fwrite($handle, $headerLine, 1000);
        for($i=0; $i<$numRecs; $i++) {
            $thisRec = $aryExport[$i];
            $thisLine = implode(',', $aryExport[$i]);

            if(!in_array($thisRec['ordernumber'], $orderProcessed)) {
                //This is a new order
                $orderProcessed[] = $thisRec['ordernumber'];
                $orderUpdate++;
            }
            fwrite($handle, $thisLine .PHP_EOL);
        }
        fclose($handle);
        
        $data = array('custUpdate' => $custUpdate,
                      'orderUpdate' => $orderUpdate);
        $result = array('status' => true,
                        'data'   => $data);
        return $result;
    }
}

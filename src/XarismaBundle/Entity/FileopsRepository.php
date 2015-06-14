<?php
namespace XarismaBundle\Entity;

use XarismaBundle\Entity\BaseRepository;

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
//            dump($aryLine);
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
            $aryImport[$row]['status']  = trim($aryLine[3]);
            $row++;
        }

        fclose($handle);
        return array('status' => true,
                     'data'   => $aryImport
                    );
    }


        
}

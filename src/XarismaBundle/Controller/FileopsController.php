<?php

namespace XarismaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use XarismaBundle\Controller\BaseController;

use XarismaBundle\Entity\Fileops;
use XarismaBundle\Form\FileopsType;

use XarismaBundle\Entity\Customer;
use XarismaBundle\Entity\Custorder;


/**
 * Fileops controller.
 *
 */
class FileopsController extends BaseController
{

    protected $importDirPath = "import";    //Relitave name of import directory
    protected $fileName = null;           //Fully-qualified inport path
    protected $md5 = null;                  //MD5 of file contents
    protected $objFileops = null;            //Import entity    

    /**
     * Lists all Fileops entities.
     *
     */
    public function indexAction()
    {
        $entities = $this->getRepo('Fileops')->getArrayList('');

        return $this->render('XarismaBundle:Fileops:index.html.twig', array(
            'entities' => $entities,
        ));    
    }
    
    
    /**
     * Creates a new Fileops entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Fileops();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fileops_show', array('id' => $entity->getId())));
        }

        return $this->render('XarismaBundle:Fileops:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Fileops entity.
     *
     * @param Fileops $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fileops $entity)
    {
        $form = $this->createForm(new FileopsType(), $entity, array(
            'action' => $this->generateUrl('fileops_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Fileops entity.
     *
     * This function will import all files in the import directory that have not yet been imported.
     */
    public function newimportAction()
    {     
        //--- Get list of files to import
        $result=$this->_getImportFile();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $aryImportFiles = $result['data'];
        
        //--- Loop through list and process impoprt file
        $numFiles = count($aryImportFiles);
        for($i=0; $i<$numFiles; $i++) {
            $importFile = $aryImportFiles[$i];
            $this->_processImportFile($importFile);
            $result = rename($importFile, $importFile.'.done');
        }
        
        //--- When done with imports, go back to list view
        $entities = $this->getRepo('Fileops')->getArrayList('');

        return $this->render('XarismaBundle:Fileops:index.html.twig', array(
            'entities' => $entities,
        ));
    }
        
    public function newexportAction()
    {
        //--- Create Fileops Object
        $objFileops = new Fileops();
        $objFileops->setEventTime(new \DateTime())
                    ->setAction('E')
                    ->setDeleted(0)
                    ->setRecs(0)
                    ->setErrors(0)
                    ->setCustomerNew(0)
                    ->setCustomerUpdate(0)
                    ->setOrderNew(0)
                    ->setOrderUpdate(0)
                    ->setStatus(Fileops::$STATUS_EXPORTING);
        
        //--- Get export filename
        $result = $this->_getExportFilePath();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->fileName = $result['data'];
        $objFileops->setFilename($this->fileName);
                
        //--- Create Export Array
        $result = $this->getrepo('fileops')->getExportArray();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $aryExport = $result['data'];

        //--- Bail out if no records to export
        if(count($aryExport) === 0) {
            //There are no records in the database that require export
            $objFileops->setStatus(Fileops::$STATUS_NORECS)
                             ->setMd5(null)
                             ->setFilename('Null');
            $this->persistEntity($objFileops);
            $this->flushEntities();
            
            $deleteForm = $this->createDeleteForm($objFileops->getId()); //Dummy form to pass to view
            return $this->render('XarismaBundle:Fileops:show.html.twig', 
                                 array('entity'      => $objFileops,
                                       'delete_form' => $deleteForm->createView(),
                                        )); 
        }
        
        $objFileops->setRecs(count($aryExport));

        //--- Write Export File
        $result = $this->getRepo('Fileops')->writeFile($aryExport, $objFileops->getFilename());
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $objFileops->setStatus(Fileops::$STATUS_SUCCESS)
                   ->setCustomerUpdate($result['data']['custUpdate'])
                   ->setOrderUpdate($result['data']['orderUpdate'])
                   ->setOrderNew(0)
                   ->setCustomerNew(0);
        
        
        //--- Generate md5 of this file for later identification
        $result = $this->_getMd5($this->fileName);
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->md5 = $result['data'];
        $objFileops->setMd5($this->md5);
        
        //--- Save Fileops Object
        $this->persistEntity($objFileops);
        $this->flushEntities();
        
        //--- Reset export flag for exported records
        $this->resetExportFlag($aryExport);

        //---Display new import record
        $deleteForm = $this->createDeleteForm($objFileops->getId()); //Dummy form to pass to view

        return $this->render('XarismaBundle:Fileops:show.html.twig', array(
            'entity'      => $objFileops,
            'delete_form' => $deleteForm->createView(),
        ));         
    }
    
    /**
     * Finds and displays a Fileops entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XarismaBundle:Fileops')->find($id);
//dump($entity);
//die();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fileops entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XarismaBundle:Fileops:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fileops entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XarismaBundle:Fileops')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fileops entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XarismaBundle:Fileops:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Process single import file
     * 
     * This function import the data from a single import file. It is called
     * repeatedly by 
     * 
     * @param type $fileFullPath Array containing full paths to files for import
     * @return type
     * @throws Exception
     */
    private function _processImportFile($fileFullPath) {

        $objFileops = new Fileops();
        $objFileops->setEventTime(new \DateTime())
                ->setAction('I')
                ->setDeleted(0)
                ->setRecs(0)
                ->setErrors(0)
                ->setFilename($fileFullPath)
                ->setCustomerNew(0)
                ->setCustomerUpdate(0)
                ->setOrderUpdate(0)
                ->setStatus(Fileops::$STATUS_IMPORTING);

        $result = $this->_getMd5($fileFullPath);
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->md5 = $result['data'];
        $objFileops->setMd5($this->md5);

        //--- Check md5 against database
        $md5IsUnique = $this->getRepo('Fileops')->md5isUnique($objFileops->getMd5());
        if($md5IsUnique !== true) {
            //md5 already exists. This file has already been processed
        }

        //--- Read file into array
        $result = $this->getRepo('Fileops')->readFile($fileFullPath);

        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $aryImport = $result['data'];
        $objFileops->setRecs(count($aryImport));

        //--- Process Customer Recs
        $result = $this->_importCustomers($aryImport);
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $objFileops->setCustomerNew($result['data']['customerNew'])
                   ->setCustomerUpdate($result['data']['customerUpdate']);

        //--- Process Order Recs
        $result = $this->_importOrders($aryImport);
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $objFileops->setOrderNew($result['data']['orderNew'])
                   ->setOrderUpdate($result['data']['orderUpdate']);
        

        //--- Save Import record
        $objFileops->setStatus(Fileops::$STATUS_SUCCESS);
        $this->persistEntity($objFileops);
        $this->flushEntities();
        
        $result = array('status' => true,
                        'data'   => $objFileops);
        return $result;
    }    
    
    /**
    * Creates a form to edit a Fileops entity.
    *
    * @param Fileops $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fileops $entity)
    {
        $form = $this->createForm(new FileopsType(), $entity, array(
            'action' => $this->generateUrl('fileops_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    
    /**
     * Edits an existing Fileops entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XarismaBundle:Fileops')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fileops entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fileops_edit', array('id' => $id)));
        }

        return $this->render('XarismaBundle:Fileops:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    
    /**
     * Deletes a Fileops entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('XarismaBundle:Fileops')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fileops entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fileops'));
    }

    
    /**
     * Creates a form to delete a Fileops entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fileops_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
    /**
     * Get list of import files
     * 
     * Return an array containing the full path of all .csv files requireing import
     * 
     * @return array 
     */
    private function _getImportFile() {
        $basePath = $this->get('kernel')->getRootDir();
        //@TODO Move import file directory to a config file
        $importDirRealPath = realpath($basePath ."/../src/XarismaBundle/" .$this->importDirPath);
        if($importDirRealPath === false) {
            return array('status' => false,
                         'data'   => 'ERROR: Could not locate import dir: ' .$this->importDirPath
                        );
        }
        $files = scandir($importDirRealPath, SCANDIR_SORT_DESCENDING);
        $aryImportFiles = array();
        $numImportFiles = count($files);
        for($i=0; $i<$numImportFiles; $i++) {
            $importFullPath = $importDirRealPath .DIRECTORY_SEPARATOR .$files[$i];
            $ext = strtolower(pathinfo($importFullPath, PATHINFO_EXTENSION));
            if($ext == 'csv' && strstr($importFullPath, 'Production') !== FALSE) {
                $aryImportFiles[] = $importFullPath;
            }
        }
        return array('status' => true,
                     'data'   => $aryImportFiles
                    );
    }

    
    /**
     * Get full path to export file
     * 
     * @return array
     */
    private function _getExportFilePath() {
        
        $basePath = $this->get('kernel')->getRootDir();
        //@TODO Refactor hard-coding of import dir to config file
        $importDirRealPath = realpath($basePath ."/../src/XarismaBundle/" .$this->importDirPath);
        if($importDirRealPath === false) {
            return array('status' => false,
                         'data'   => 'ERROR: Could not locate export dir: ' .$this->importDirPath
                        );
        }
        
        $datestring = date("Y-m-d_h-m-n-s");
        $importDirRealPath .= '/export_' .$datestring .'.csv';
        $result = array('status' => true,
                        'data'   => $importDirRealPath
                       );
        if($importDirRealPath === false) {
            return array('status' => false,
                         'data'   => 'ERROR: Could not set export file: ' .$this->importDirPath
                        );
        }
        return $result;
    }
    
    
    /**
     * Get md5 hash for a file
     * 
     * This function will read a file, and return it's md5 hash, uniquiely
     * identifying the contents of the file.
     * 
     * @param string $fileFullPath Full path to file
     * @return array
     */
    private function _getMd5($fileFullPath) {
        if(($fileContents = file_get_contents($fileFullPath)) === false) {
            return array('status' => false,
                         'data'   => 'ERROR: Could read import file: ' .$fileFullPath
                        );
        }
        $md5 = md5($fileContents);
        return array('status' => true,
                     'data'   => $md5
                    );
    }
 
    
    /**
     * Import customer Orders
     * 
     * Import customer orders from the import array passed as a parameter, and
     * return customer record counts.
     * 
     * @param array $aryImport
     * @return type
     * @throws \Exception
     */
    private function _importOrders(array $aryImport) {
        $numRecs   = count($aryImport);
        $newOrd    = 0;
        $updateOrd = 0;
        
        for($i=0; $i<$numRecs; $i++) {
            $orderNum = $aryImport[$i]['orderNum'];
            
            $order = $this->getRepo('Custorder')->findByOrdernumber($orderNum);
            if(!$order) {
                //This is a new order record
                $newOrd++;
                $customer = $this->getRepo('Customer')->findByCustomerNum($aryImport[$i]['customernumber']);
                if(!$customer) {
                    throw new \Exception("ERROR: Could not find customer record for Customer#: {$aryImport[$i]['customernumber']}");
                }
                $order = new Custorder();
                $order->setOrderdate(new \DateTime($aryImport[$i]['orderDate']));
                $order->setOrdernumber($orderNum);
                $order->setCustomerId($customer->getId());
                $order->setCustomer($customer);
                $order->setOrderstatus(Custorder::$STATUS_RECEIVED);
                $order->setNeedsexport(false);
                $order->setDeleted(0);
                $order->setNeedsexport(false);
                $this->persistEntity($order);
            } else {
                //This is an existing order record
                //@TODO Do something with updated order records
            }
        }
        $this->flushEntities();
        
        $data = array('orderNew' => $newOrd,
                      'orderUpdate' => $updateOrd);
        $response = array('status' => true,
                          'data'   => $data);
        return $response;
    }    
  
    
    /**
     * Import customer records
     * 
     * This function will import customer records from the array passed as a
     * paramter, and return the count of records created/updated
     * 
     * @param type $aryImport
     * @return type
     */    
    private function _importCustomers($aryImport) {
        
        $numRecs = count($aryImport);
        $aryProcessed = array();
        $newCust = 0;
        $updateCust = 0;
        
        for($i=0; $i<$numRecs; $i++) {
            $customerNum = $aryImport[$i]['customernumber'];
            
            if(in_array($customerNum, $aryProcessed)) {
                continue;
            }
            $aryProcessed[] = $customerNum;
            $customer = $this->getRepo('Customer')->findByCustomerNum($customerNum);
            if(!$customer) {
                //This is a new customer record
                $newCust++;
                $customer = new Customer();
                $customer->setDeleted(0);
                $customer->setCustomernumber($customerNum);
                $customer->setAccountname($aryImport[$i]['accountname']);
                $customer->setDatecreated(new \DateTime());
                $this->persistEntity($customer);
            } else {
                //This is an existing customer record
                //@TODO Do something with updated customer records
            }
        }
        $this->flushEntities();
        $data = array('customerNew'    => $newCust,
                      'customerUpdate' => $updateCust);
        $result = array('status' => true,
                        'data'   => $data);
        return $result;
    }
    
    
    /**
     * Reset 'needsExport' flag for customer orders
     * 
     * This function will reset the 'needsExport' flag for customer orders, whos
     * ordernumbers are passed in an array. This function uses a direct database
     * query, rather than using the Doctrine ORM. This is to avoid the ORM firing
     * lifecycle events that would set the 'needsExport' flag again upon update.
     * 
     * @todo Move resetExportFlag function somewhere better, probably the repository
     * @todo Make $aryOrderList param optional. Reset flag for ALL records if list is not provided
     * 
     * @param array $aryOrderList
     * @return boolean True if update succeeded, false otherwise
     */
    public function resetExportFlag(array $aryOrderList) {

        $aryReset  = array_column($aryOrderList, 'ordernumber');
        $resetList = implode($aryReset, ',');
        $sql = "UPDATE custorder SET needsexport=false \n"
             . "WHERE orderNumber in($resetList)";
        $connection = $this->getDoctrine()->getManager()->getConnection();
        $statement = $connection->prepare($sql);
        $result = $statement->execute();
        return $result;
    }
    
}

<?php

namespace XarismaBundle\Controller;

use XarismaBundle\Controller\BaseController;
use XarismaBundle\Entity\Import;
use XarismaBundle\Entity\Customer;
use XarismaBundle\Entity\Custorder;

use XarismaBundle\Form\ImportType;

/**
 * Import controller
 *
 */
class ImportController extends BaseController
{
    protected $importDirPath = "import";    //Relitave name of import directory
    protected $importFile = null;           //Fully-qualified inport path
    protected $md5 = null;                  //MD5 of file contents
    protected $objImport = null;            //Import entity

    /**
     * Lists all Import entities.
     *
     */
    public function indexAction()
    {
        $entities = $this->getRepo('Import')->getArrayList('');
//dump($entities);
//die();

        return $this->render('XarismaBundle:Import:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Import entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Import();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getRepo('Import')->persistEntity($entity);
            $this->getRepo('Import')->flushEntities();

            return $this->redirect($this->generateUrl('import_show', array('id' => $entity->getId())));
        }

        return $this->render('XarismaBundle:Import:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Import entity.
     *
     * @param Import $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Import $entity)
    {
        $form = $this->createForm(new ImportType(), $entity, array(
            'action' => $this->generateUrl('import_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Import entity.
     *
     */
    public function newAction()
    {
        $this->objImport = new Import();
        $this->objImport->setImportTime(new \DateTime())
                    ->setDeleted(0)
                    ->setRecs(0)
                    ->setErrors(0)
                    ->setCustomerNew(0)
                    ->setCustomerUpdate(0)
                    ->setStatus(Import::$STATUS_IMPORTING);
        
        //--- Find import file
        $result=$this->_getImportFile();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->importFile = $result['data'];
        $this->objImport->setFilename($this->importFile);
        
        
        //--- Generate  md5 of file
        $result = $this->_getMd5();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->md5 = $result['data'];
        $this->objImport->setMd5($this->md5);
        
        //--- Check md5 against database
        $md5IsUnique = $this->getRepo('Import')->md5isUnique($this->objImport->getMd5());
        if($md5IsUnique !== true) {
            //md5 already exists. This file has already been processed
        }
        
        //--- Read file into array
        $result = $this->getRepo('Import')->readFile($this->importFile);
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $aryImport = $result['data'];
        $this->objImport->setRecs(count($aryImport));
//        
//dump($aryImport);
//die();
        
        //--- Process Customer Recs
        $result = $this->_importCustomers($aryImport);
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        
        
        //--- Process Order Recs
        $result = $this->_importOrders($aryImport);
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        
        //--- Save Import record
        $this->objImport->setStatus(Import::$STATUS_SUCCESS);
        $this->persistEntity($this->objImport);
        $this->flushEntities();
        
        //---Display new import record
        $deleteForm = $this->createDeleteForm($this->objImport->getId()); //Dummy form to pass to view

        return $this->render('XarismaBundle:Import:show.html.twig', array(
            'entity'      => $this->objImport,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a Import entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getRepo('Import')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Import entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('XarismaBundle:Import:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Import entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->getRepo('Import')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Import entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XarismaBundle:Import:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Import entity.
    *
    * @param Import $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Import $entity)
    {
        $form = $this->createForm(new ImportType(), $entity, array(
            'action' => $this->generateUrl('import_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Import entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getRepo('Import')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Import entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('import_edit', array('id' => $id)));
        }

        return $this->render('XarismaBundle:Import:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Import entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getRepo('Import')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Import entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('import'));
    }

    /**disrespecfuldisrespecful
     * Creates a form to delete a Import entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('import_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    private function _getImportFile()
    {
        $basePath = $this->get('kernel')->getRootDir();
        $importDirRealPath = realpath($basePath ."/../src/XarismaBundle/" .$this->importDirPath);
        if($importDirRealPath === false) {
            return array('status' => false,
                         'data'   => 'ERROR: Could not locate import dir: ' .$this->importDirPath
                        );
        }
        $files = scandir($importDirRealPath, SCANDIR_SORT_DESCENDING);
        $newest_file = $files[0];
        $importFullPath = $importDirRealPath .DIRECTORY_SEPARATOR .$newest_file;
        return array('status' => true,
                     'data'   => $importFullPath
                    );
    }

    private function _getMd5()
    {
        if(($fileContents = file_get_contents($this->importFile)) === false) {
            return array('status' => false,
                         'data'   => 'ERROR: Could read import file: ' .$this->importFile
                        );
        }
        $md5 = md5($fileContents);
        return array('status' => true,
                     'data'   => $md5
                    );
    }
    
    
    
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
        $this->objImport->setCustomerNew($newCust);
        return null;
    }
    
    
    private function _importOrders($aryImport) {
        $numRecs   = count($aryImport);
        $newOrd    = 0;
        $updateOrd = 0;
        
        for($i=0; $i<$numRecs; $i++) {
            $orderNum = $aryImport[$i]['orderNum'];
//dump($orderNum);
//die();
            
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
                $order->setDeleted(0);
                $order->setDatecreated(new \DateTime());
//dump($aryImport[$i]);
//dump($customer);
//dump($customer->getId());
//dump($order);
//die();
                $order->setDatecreated(new \DateTime());
                $this->persistEntity($order);
            } else {
                //This is an existing order record
                //@TODO Do something with updated order records
            }
        }
        $this->flushEntities();
        $this->objImport->setOrderNew($newOrd);
        return null;
    }
    
}

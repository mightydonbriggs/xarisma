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
    protected $importFile = null;           //Fully-qualified inport path
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
     */
    public function newimportAction()
    {
        $this->objFileops = new Fileops();
        $this->objFileops->setEventTime(new \DateTime())
                    ->setAction('I')
                    ->setDeleted(0)
                    ->setRecs(0)
                    ->setErrors(0)
                    ->setCustomerNew(0)
                    ->setCustomerUpdate(0)
                    ->setStatus(Fileops::$STATUS_IMPORTING);
        
        //--- Find import file
        $result=$this->_getImportFile();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->importFile = $result['data'];
        $this->objFileops->setFilename($this->importFile);
        
        //--- Generate  md5 of file
        $result = $this->_getMd5();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->md5 = $result['data'];
        $this->objFileops->setMd5($this->md5);
        
        //--- Check md5 against database
        $md5IsUnique = $this->getRepo('Fileops')->md5isUnique($this->objFileops->getMd5());
        if($md5IsUnique !== true) {
            //md5 already exists. This file has already been processed
        }
        
//dump($this);
//die();
        
        //--- Read file into array
        $result = $this->getRepo('Fileops')->readFile($this->importFile);

        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $aryImport = $result['data'];
        $this->objFileops->setRecs(count($aryImport));
        
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
        $this->objFileops->setStatus(Fileops::$STATUS_SUCCESS);
        $this->persistEntity($this->objFileops);
        $this->flushEntities();
        
        //---Display new import record
        $deleteForm = $this->createDeleteForm($this->objFileops->getId()); //Dummy form to pass to view

        return $this->render('XarismaBundle:Fileops:show.html.twig', array(
            'entity'      => $this->objFileops,
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
 
    private function _importOrders($aryImport) {
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
                $order->setDeleted(0);
                $order->setDatecreated(new \DateTime());

                $order->setDatecreated(new \DateTime());
                $this->persistEntity($order);
            } else {
                //This is an existing order record
                //@TODO Do something with updated order records
            }
        }
        $this->flushEntities();
        $this->objFileops->setOrderNew($newOrd);
        return null;
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
        $this->objFileops->setCustomerNew($newCust);
        return null;
    }
}

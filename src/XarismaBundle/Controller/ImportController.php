<?php

namespace XarismaBundle\Controller;

use XarismaBundle\Controller\BaseController;

use XarismaBundle\Entity\Import;
use XarismaBundle\Form\ImportType;

/**
 * Import controller.
 *
 */
class ImportController extends BaseController
{
    protected $importDirPath = "import";
    protected $importFile = null;
    protected $md5 = null;

    /**
     * Lists all Import entities.
     *
     */
    public function indexAction()
    {
        $entities = $this->getRepo('Import')->findAll();

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
        $objImport = new Import();
        $objImport->setImportTime(new \DateTime())
                    ->setDeleted(0)
                    ->setRecs(0)
                    ->setErrors(0)
                    ->setStatus(Import::$STATUS_IMPORTING);
print "<pre>\n";

        //--- Find import file
        $result=$this->_getImportFile();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->importFile = $result['data'];
        $objImport->setFilename($this->importFile);
        
        
        //--- enerate  md5 of file
        $result = $this->_getMd5();
        if($result['status'] === false) {
            throw new Exception($result['data']);
        }
        $this->md5 = $result['data'];
        $objImport->setMd5($this->md5);
        
        //--- Check md5 against database
        $md5IsUnique = $this->getRepo('Import')->md5isUnique($objImport->getMd5());
        if($md5IsUnique !== true) {
            //md5 already exists. This file has already been processed
        }
        
dump($objImport);
die();
        
        //--- Read file into array
        
        //--- Process Customer Recs
        
        //--- Process Order Recs
        
dump($objImport);        
die("BOING!!!\n");
//        $form   = $this->createCreateForm($entity);
        return $this->render('XarismaBundle:Import:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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
    
}

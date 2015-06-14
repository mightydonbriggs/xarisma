<?php

namespace XarismaBundle\Controller;

use XarismaBundle\Controller\BaseController; 

use XarismaBundle\Entity\Custorder;
use XarismaBundle\Form\CustorderType;

/**
 * Custorder controller.
 *
 */
class CustorderController extends BaseController
{

    /**
     * Lists all Custorder records.
     *
     */
    public function indexAction()
    {
        $entities = $this->getRepo('Custorder')->getArrayList();

        return $this->render('XarismaBundle:Custorder:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Custorder entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Custorder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('custorder_show', array('id' => $entity->getId())));
        }

        return $this->render('XarismaBundle:Custorder:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Custorder entity.
     *
     * @param Custorder $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Custorder $entity)
    {
        $form = $this->createForm(new CustorderType(), $entity, array(
            'action' => $this->generateUrl('custorder_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Custorder entity.
     *
     */
    public function newAction()
    {
        $entity = new Custorder();
        $form   = $this->createCreateForm($entity);

        return $this->render('XarismaBundle:Custorder:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Custorder entity.
     *
     */
    public function showAction($id)
    {
        $entity = $this->getRepo('Custorder')->find($id);
        $entity->getCustomer()->getAccountname();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Custorder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XarismaBundle:Custorder:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Custorder entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->getRepo('Custorder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Custorder entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XarismaBundle:Custorder:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Custorder entity.
    *
    * @param Custorder $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Custorder $entity)
    {
        $form = $this->createForm(new CustorderType(), $entity, array(
            'action' => $this->generateUrl('custorder_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Custorder entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getRepo('Custorder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Custorder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('custorder_edit', array('id' => $id)));
        }

        return $this->render('XarismaBundle:Custorder:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Custorder entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->getRepo('Custorder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Custorder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('custorder'));
    }

    /**
     * Creates a form to delete a Custorder entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('custorder_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

<?php

namespace XarismaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use XarismaBundle\Entity\Worklog;
use XarismaBundle\Form\WorklogType;

/**
 * Worklog controller.
 *
 */
class WorklogController extends Controller
{

    /**
     * Lists all Worklog entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('XarismaBundle:Worklog')->findAll();

        return $this->render('XarismaBundle:Worklog:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Worklog entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Worklog();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('worklog_show', array('id' => $entity->getId())));
        }

        return $this->render('XarismaBundle:Worklog:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Worklog entity.
     *
     * @param Worklog $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Worklog $entity)
    {
        $form = $this->createForm(new WorklogType(), $entity, array(
            'action' => $this->generateUrl('worklog_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Worklog entity.
     *
     */
    public function newAction()
    {
        $entity = new Worklog();
        $form   = $this->createCreateForm($entity);

        return $this->render('XarismaBundle:Worklog:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Worklog entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XarismaBundle:Worklog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Worklog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XarismaBundle:Worklog:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Worklog entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XarismaBundle:Worklog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Worklog entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XarismaBundle:Worklog:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Worklog entity.
    *
    * @param Worklog $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Worklog $entity)
    {
        $form = $this->createForm(new WorklogType(), $entity, array(
            'action' => $this->generateUrl('worklog_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Worklog entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XarismaBundle:Worklog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Worklog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('worklog_edit', array('id' => $id)));
        }

        return $this->render('XarismaBundle:Worklog:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Worklog entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('XarismaBundle:Worklog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Worklog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('worklog'));
    }

    /**
     * Creates a form to delete a Worklog entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('worklog_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

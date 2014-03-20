<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Personal;
use CDI\EnfermeriaBundle\Form\PersonalType;

/**
 * Personal controller.
 *
 * @Route("/personal")
 */
class PersonalController extends Controller
{

    /**
     * Lists all Personal entities.
     *
     * @Route("/", name="personal")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:Personal')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Personal entity.
     *
     * @Route("/", name="personal_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Personal:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Personal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('personal_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Personal entity.
    *
    * @param Personal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Personal $entity)
    {
        $form = $this->createForm(new PersonalType(), $entity, array(
            'action' => $this->generateUrl('personal_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Personal entity.
     *
     * @Route("/new", name="personal_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Personal();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Personal entity.
     *
     * @Route("/{id}", name="personal_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Personal entity.
     *
     * @Route("/{id}/edit", name="personal_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Personal entity.
    *
    * @param Personal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Personal $entity)
    {
        $form = $this->createForm(new PersonalType(), $entity, array(
            'action' => $this->generateUrl('personal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

       return $form;
    }
    /**
     * Edits an existing Personal entity.
     *
     * @Route("/{id}", name="personal_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Personal:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('personal_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Personal entity.
     *
     * @Route("/{id}", name="personal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Personal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Personal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('personal'));
    }

    /**
     * Creates a form to delete a Personal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personal_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}

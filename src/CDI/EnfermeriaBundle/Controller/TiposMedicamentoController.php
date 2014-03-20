<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\TiposMedicamento;
use CDI\EnfermeriaBundle\Form\TiposMedicamentoType;

/**
 * TiposMedicamento controller.
 *
 * @Route("/tiposmedicamento")
 */
class TiposMedicamentoController extends Controller
{

    /**
     * Lists all TiposMedicamento entities.
     *
     * @Route("/", name="tiposmedicamento")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:TiposMedicamento')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TiposMedicamento entity.
     *
     * @Route("/", name="tiposmedicamento_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:TiposMedicamento:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TiposMedicamento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tiposmedicamento_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a TiposMedicamento entity.
    *
    * @param TiposMedicamento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TiposMedicamento $entity)
    {
        $form = $this->createForm(new TiposMedicamentoType(), $entity, array(
            'action' => $this->generateUrl('tiposmedicamento_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));


        return $form;
    }

    /**
     * Displays a form to create a new TiposMedicamento entity.
     *
     * @Route("/new", name="tiposmedicamento_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TiposMedicamento();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TiposMedicamento entity.
     *
     * @Route("/{id}", name="tiposmedicamento_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:TiposMedicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposMedicamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TiposMedicamento entity.
     *
     * @Route("/{id}/edit", name="tiposmedicamento_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:TiposMedicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposMedicamento entity.');
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
    * Creates a form to edit a TiposMedicamento entity.
    *
    * @param TiposMedicamento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TiposMedicamento $entity)
    {
        $form = $this->createForm(new TiposMedicamentoType(), $entity, array(
            'action' => $this->generateUrl('tiposmedicamento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));


       return $form;
    }
    /**
     * Edits an existing TiposMedicamento entity.
     *
     * @Route("/{id}", name="tiposmedicamento_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:TiposMedicamento:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:TiposMedicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposMedicamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tiposmedicamento_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TiposMedicamento entity.
     *
     * @Route("/{id}", name="tiposmedicamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:TiposMedicamento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TiposMedicamento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tiposmedicamento'));
    }

    /**
     * Creates a form to delete a TiposMedicamento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposmedicamento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}

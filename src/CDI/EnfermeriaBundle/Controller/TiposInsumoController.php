<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\TiposInsumo;
use CDI\EnfermeriaBundle\Form\TiposInsumoType;

/**
 * TiposInsumo controller.
 *
 * @Route("/tiposinsumo")
 */
class TiposInsumoController extends Controller
{

    /**
     * Lists all TiposInsumo entities.
     *
     * @Route("/", name="tiposinsumo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:TiposInsumo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TiposInsumo entity.
     *
     * @Route("/", name="tiposinsumo_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:TiposInsumo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TiposInsumo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tiposinsumo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a TiposInsumo entity.
    *
    * @param TiposInsumo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TiposInsumo $entity)
    {
        $form = $this->createForm(new TiposInsumoType(), $entity, array(
            'action' => $this->generateUrl('tiposinsumo_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

       
        return $form;
    }

    /**
     * Displays a form to create a new TiposInsumo entity.
     *
     * @Route("/new", name="tiposinsumo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TiposInsumo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TiposInsumo entity.
     *
     * @Route("/{id}", name="tiposinsumo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:TiposInsumo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposInsumo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TiposInsumo entity.
     *
     * @Route("/{id}/edit", name="tiposinsumo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:TiposInsumo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposInsumo entity.');
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
    * Creates a form to edit a TiposInsumo entity.
    *
    * @param TiposInsumo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TiposInsumo $entity)
    {
        $form = $this->createForm(new TiposInsumoType(), $entity, array(
            'action' => $this->generateUrl('tiposinsumo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar','attr' => array('class' => 'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing TiposInsumo entity.
     *
     * @Route("/{id}", name="tiposinsumo_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:TiposInsumo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:TiposInsumo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposInsumo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tiposinsumo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TiposInsumo entity.
     *
     * @Route("/{id}", name="tiposinsumo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:TiposInsumo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TiposInsumo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tiposinsumo'));
    }

    /**
     * Creates a form to delete a TiposInsumo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposinsumo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}

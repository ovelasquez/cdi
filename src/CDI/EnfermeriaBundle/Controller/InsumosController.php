<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Insumos;
use CDI\EnfermeriaBundle\Form\InsumosType;

/**
 * Insumos controller.
 *
 * @Route("/insumos")
 */
class InsumosController extends Controller
{

    /**
     * Lists all Insumos entities.
     *
     * @Route("/", name="insumos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:Insumos')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Insumos entity.
     *
     * @Route("/", name="insumos_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Insumos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Insumos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('insumos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Insumos entity.
    *
    * @param Insumos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Insumos $entity)
    {
        $form = $this->createForm(new InsumosType(), $entity, array(
            'action' => $this->generateUrl('insumos_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

       /* $form->add('submit', 'submit', array('label' => 'Registrar','attr' => array('class' => 'btn btn-primary')));*/

        return $form;
    }

    /**
     * Displays a form to create a new Insumos entity.
     *
     * @Route("/new", name="insumos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Insumos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Insumos entity.
     *
     * @Route("/{id}", name="insumos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Insumos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Insumos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Insumos entity.
     *
     * @Route("/{id}/edit", name="insumos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Insumos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Insumos entity.');
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
    * Creates a form to edit a Insumos entity.
    *
    * @param Insumos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Insumos $entity)
    {
        $form = $this->createForm(new InsumosType(), $entity, array(
            'action' => $this->generateUrl('insumos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

      return $form;
    }
    /**
     * Edits an existing Insumos entity.
     *
     * @Route("/{id}", name="insumos_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Insumos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Insumos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Insumos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('insumos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Insumos entity.
     *
     * @Route("/{id}", name="insumos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Insumos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Insumos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('insumos'));
    }

    /**
     * Creates a form to delete a Insumos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('insumos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}

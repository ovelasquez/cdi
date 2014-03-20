<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Datos;
use CDI\EnfermeriaBundle\Form\DatosType;

/**
 * Datos controller.
 *
 * @Route("/datos")
 */
class DatosController extends Controller
{

    /**
     * Lists all Datos entities.
     *
     * @Route("/", name="datos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:Datos')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Datos entity.
     *
     * @Route("/", name="datos_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Datos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Datos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('datos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Datos entity.
    *
    * @param Datos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Datos $entity)
    {
        $form = $this->createForm(new DatosType(), $entity, array(
            'action' => $this->generateUrl('datos_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

       return $form;
    }

    /**
     * Displays a form to create a new Datos entity.
     *
     * @Route("/new", name="datos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Datos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Datos entity.
     *
     * @Route("/{id}", name="datos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Datos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Datos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Datos entity.
     *
     * @Route("/{id}/edit", name="datos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Datos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Datos entity.');
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
    * Creates a form to edit a Datos entity.
    *
    * @param Datos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Datos $entity)
    {
        $form = $this->createForm(new DatosType(), $entity, array(
            'action' => $this->generateUrl('datos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

         return $form;
    }
    /**
     * Edits an existing Datos entity.
     *
     * @Route("/{id}", name="datos_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Datos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Datos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Datos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('datos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Datos entity.
     *
     * @Route("/{id}", name="datos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Datos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Datos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('datos'));
    }

    /**
     * Creates a form to delete a Datos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('datos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}
